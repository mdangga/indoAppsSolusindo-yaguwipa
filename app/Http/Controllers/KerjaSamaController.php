<?php

namespace App\Http\Controllers;

use App\Models\FilePenunjang;
use App\Models\KategoriKerjaSama;
use App\Models\KerjaSama;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'id_kategori_kerja_sama' => 'required',
            'kategori_baru' => 'required_if:id_kategori_kerja_sama,other|string|nullable',
            'id_program' => 'required|exists:program,id_program',
            'keterangan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'file_penunjang' => 'nullable|array',
            'file_penunjang.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $mitra = Auth::user()->mitra;
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
                // Pastikan ini adalah ID yang valid
                $kategoriId = (int)$request->id_kategori_kerja_sama;

                // Validasi tambahan
                if (!KategoriKerjaSama::where('id_kategori_kerja_sama', $kategoriId)->exists()) {
                    return back()->withErrors(['id_kategori_kerja_sama' => 'Kategori tidak valid']);
                }
            }

            $kerjaSama = KerjaSama::create([
                'id_mitra' => $mitra->id_mitra,
                'id_program' => $request->id_program,
                'id_kategori_kerja_sama' => $kategoriId,
                'keterangan' => $request->keterangan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status' => 'pending',
            ]);

            // Handle file uploads
            if ($request->hasFile('file_penunjang')) {
                foreach ($request->file('file_penunjang') as $file) {
                    // Generate unique filename
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('file_penunjang', $filename, 'public');

                    FilePenunjang::create([
                        'id_kerja_sama' => $kerjaSama->id_kerja_sama,
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Pengajuan kerja sama berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error in kerja-sama.store: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
