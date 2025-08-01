<?php

namespace App\Http\Controllers;

use App\Models\FilePenunjang;
use App\Models\KategoriKerjaSama;
use App\Models\KerjaSama;
use App\Models\Program;
use App\Notifications\KerjaSamaDisetujui;
use App\Notifications\KerjaSamaDitolak;
use App\Notifications\NotifikasiPengajuanKerjaSama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class KerjaSamaController extends Controller
{

    public function show()
    {
        $kategoriKerjaSama = KategoriKerjaSama::all();
        $programs = Program::where('status', 'aktif')->get();

        return view('user.mitra.formKerjaSama', compact('kategoriKerjaSama', 'programs'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori_kerja_sama' => 'nullable',
            'kategori_baru' => 'required_if:id_kategori_kerja_sama,other|string|max:255|nullable',
            'id_program' => 'required|exists:program,id_program',
            'keterangan' => 'required|string|max:1000',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'file_penunjang' => 'nullable|array|max:4',
            'file_penunjang.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ], [
            'kategori_baru.required_if' => 'Kategori baru harus diisi ketika memilih "Lainnya"',
            'id_program.required' => 'Program harus dipilih',
            'id_program.exists' => 'Program yang dipilih tidak valid',
            'keterangan.required' => 'Keterangan harus diisi',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
            'file_penunjang.max' => 'Maksimal 4 file yang boleh diunggah',
            'file_penunjang.*.max' => 'Ukuran file maksimal 2MB',
            'file_penunjang.*.mimes' => 'Format file yang diperbolehkan: pdf, jpg, jpeg, png, doc, docx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('file_penunjang'))
                ->with('error', 'Terdapat kesalahan dalam pengisian form');
        }

        DB::beginTransaction();

        try {
            $mitra = Auth::user()->mitra;
            $user = Auth::user();

            if (!$mitra) {
                return back()->with('error', 'Anda bukan mitra terdaftar.');
            }

            // Handle kategori
            if ($request->id_kategori_kerja_sama == 'other') {
                $kategori = KategoriKerjaSama::create([
                    'nama' => $request->kategori_baru
                ]);
                $kategoriId = $kategori->id_kategori_kerja_sama;
            } else {
                $kategoriId = (int)$request->id_kategori_kerja_sama;

                if (!KategoriKerjaSama::where('id_kategori_kerja_sama', $kategoriId)->exists()) {
                    return back()->withErrors(['id_kategori_kerja_sama' => 'Kategori tidak valid']);
                }
            }

            // Validate file count again (in case of direct API call bypassing client-side validation)
            if ($request->hasFile('file_penunjang') && count($request->file('file_penunjang')) > 4) {
                return back()->withErrors(['file_penunjang' => 'Maksimal 4 file yang boleh diunggah.']);
            }

            $kerjaSama = KerjaSama::create([
                'id_mitra' => $mitra->id_mitra,
                'id_program' => $request->id_program,
                'id_kategori_kerja_sama' => $kategoriId,
                'keterangan' => $request->keterangan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status' => 'pending',
                'created_by' => $user->id,
            ]);

            // Handle file uploads
            if ($request->hasFile('file_penunjang')) {
                foreach ($request->file('file_penunjang') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::uuid() . '.' . $extension;
                    $path = $file->storeAs('file_penunjang', $filename, 'public');

                    FilePenunjang::create([
                        'id_kerja_sama' => $kerjaSama->id_kerja_sama,
                        'file_path' => $path,
                        'nama_file' => $originalName,
                        'file_size' => $file->getSize(),
                        'file_type' => $extension,
                    ]);
                }
            }

            // Send notification to admins
            $pengajuanNotif = [
                'nama' => $user->nama,
                'keterangan' => $kerjaSama->keterangan,
                'id' => $kerjaSama->id_kerja_sama
            ];

            $adminUsers = \App\Models\User::where('role', 'admin')->get();
            Notification::send($adminUsers, new NotifikasiPengajuanKerjaSama($pengajuanNotif));

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Pengajuan kerja sama berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error in kerja-sama.store: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'input' => $request->except(['file_penunjang', '_token'])
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }


    // admin
    public function index()
    {
        return view('admin.showKerjaSama');
    }

    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $users = KerjaSama::with('Mitra.User', 'KategoriKerjaSama', 'Program')
            ->select(['id_kerja_sama', 'keterangan', 'id_mitra', 'id_kategori_kerja_sama', 'id_program', 'status']);

        return DataTables::of($users)
            ->addColumn('nama', function ($row) {
                return $row->Mitra->User->nama ?? '-';
            })
            ->addColumn('kategori', function ($row) {
                return $row->KategoriKerjaSama->nama ?? '-';
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function approved($id)
    {
        try {
            $kerjaSama = KerjaSama::with('Mitra.User')->findOrFail($id);

            DB::transaction(function () use ($kerjaSama) {
                $kerjaSama->update(['status' => 'approved']);

                $user = $kerjaSama->Mitra->User;
                if ($user) {
                    $user->notify(new KerjaSamaDisetujui($kerjaSama));
                }
            });

            return back()->with('success', 'Kerja Sama Diterima');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyetujui kerja sama: ' . $e->getMessage());
        }
    }


    public function rejected($id)
    {
        try {
            $kerjaSama = KerjaSama::with('Mitra.User')->findOrFail($id);

            DB::transaction(function () use ($kerjaSama) {
                $kerjaSama->update(['status' => 'rejected']);

                $user = $kerjaSama->Mitra->User;
                if ($user) {
                    $user->notify(new KerjaSamaDitolak($kerjaSama));
                }
            });

            return back()->with('success', 'Kerja Sama Diterima');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyetujui kerja sama: ' . $e->getMessage());
        }
    }

    public function detailKerjaSama($id)
    {
        $kerjasama = KerjaSama::with('Mitra.User', 'FilePenunjang', 'KategoriKerjaSama', 'Program')
            ->findOrFail($id);
        return view('admin.showDetailKerjaSama', compact('kerjasama'));
    }
}
