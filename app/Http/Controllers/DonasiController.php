<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donasi;
use App\Models\DonasiBarang;
use App\Models\DonasiDana;
use App\Models\DonasiJasa;
use App\Models\Donatur;
use App\Models\JenisDonasi;
use App\Notifications\donasiDiterima;
use App\Notifications\donasiDitolak;
use App\Notifications\notifikasiPengajuanDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DonasiController extends Controller
{
    public function show($id_campaign)
    {
        $campaign = null;
        if ($id_campaign) {
            $campaign = Campaign::findOrFail($id_campaign);
        }
        return view('formDonasi', compact('campaign'));
    }

    public function showDetailDOnasi($id)
    {
        $user = Auth::user();

        $donasi = Donasi::with('Campaign', 'JenisDonasi', 'DonasiBarang', 'DonasiJasa')
            ->where('id_user', $user->id_user)
            ->findOrFail($id);

        return view('user.detailDonasi', compact('donasi'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'            => 'required|string|max:255',
            'email_tlp'       => 'required|email', // Changed from 'email' to 'email_tlp'
            'anonim'          => 'required|boolean',
            'id_campaign'     => 'required|exists:campaign,id_campaign',
            'jenis_donasi' => 'required|string|in:dana,barang,jasa',
            'pesan'           => 'nullable|string',

            // Barang (multiple)
            'DonasiBarang'                  => 'required_if:id_jenis_donasi,2|array|min:1',
            'DonasiBarang.*.nama_barang'    => 'required_if:id_jenis_donasi,2|string|max:255',
            'DonasiBarang.*.jumlah_barang'  => 'required_if:id_jenis_donasi,2|integer|min:1',
            'DonasiBarang.*.kondisi'        => 'required_if:id_jenis_donasi,2|in:baru,bekas',
            'DonasiBarang.*.deskripsi'      => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            $jenis_donasi = JenisDonasi::where('nama', $request->jenis_donasi)->first();

            $donasi = Donasi::create([
                'nama'            => $request->nama,
                'email'           => $request->email_tlp,
                'pesan'           => $request->pesan,
                'anonim'          => $request->anonim,
                'id_user'         => auth()->user()->id_user ?? null,
                'id_campaign'     => $request->id_campaign,
                'id_jenis_donasi' => $jenis_donasi->id_jenis_donasi,
            ]);


            if ($request->jenis_donasi == 'dana') { // Dana
                DonasiDana::create([
                    'id_donasi'         => $donasi->id_donasi,
                    'nominal'           => $request->nominal,
                    'payment_id'        => $request->payment_id,
                    'payment_method'    => $request->payment_method,
                    'payment_token'     => $request->payment_token,
                    'payment_url'       => $request->payment_url,
                    'status_verifikasi' => 'pending',
                    'expired_at'        => now()->addDays(1)
                ]);
            }
            if ($request->jenis_donasi == 'barang') { // Barang
                foreach ($request->DonasiBarang as $item) {
                    DonasiBarang::create([
                        'id_donasi'         => $donasi->id_donasi,
                        'nama_barang'       => $item['nama_barang'],
                        'jumlah_barang'     => $item['jumlah_barang'] ?? 1,
                        'deskripsi'         => $item['deskripsi'] ?? null,
                        'kondisi'           => $item['kondisi'] ?? 'baru',
                        'status_verifikasi' => 'pending'
                    ]);
                }
            }
            if ($request->jenis_donasi == 'jasa') {
                DonasiJasa::create([
                    'id_donasi'         => $donasi->id_donasi,
                    'jenis_jasa'        => $request->jenis_jasa,
                    'durasi_jasa'       => $request->durasi_jasa,
                    'status_verifikasi' => 'pending'
                ]);
            }

            $pengajuanNotif = [
                'nama' => $request->nama,
                'jenis_donasi' => $jenis_donasi->nama,
                'id' => $donasi->id_donasi,
            ];
            // Kirim notifikasi ke admin
            $adminUsers = \App\Models\User::where('role', 'admin')->get();
            Notification::send($adminUsers, new notifikasiPengajuanDonasi($pengajuanNotif));

            DB::commit();
            // Redirect ke halaman detail campaign
            return redirect()->route('campaign.slug', $donasi->Campaign->slug)
                ->with('success', 'Pengajuan donasi berhasil dibuat. Silakan tunggu verifikasi dari admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Gagal membuat donasi: ' . $e->getMessage()
            ]);
        }
    }

    // fungsi untuk menyetujui barang
    public function approveBarang($id)
    {
        try {
            $barang = DonasiBarang::findOrFail($id);

            DB::transaction(function () use ($barang) {
                $barang->update(['status_verifikasi' => 'approved']);

                // Kalau mau kirim notifikasi ke user
                // $user = $barang->Donasi->User ?? null;
                // if ($user) {
                //     $user->notify(new BarangDonasiDisetujui($barang));
                // }
            });

            return back()->with('success', 'Barang donasi berhasil disetujui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyetujui barang donasi: ' . $e->getMessage());
        }
    }


    //admin

    // fungsi menampilkan kerja sama di halaman admin
    public function index()
    {
        return view('admin.showDonasi');
    }


    // fungsi membuatkan datatable kerja sama di halaman admin
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $users = Donasi::with('JenisDonasi', 'DonasiBarang', 'DonasiDana', 'DonasiJasa')
            ->select(['id_donasi', 'nama', 'id_jenis_donasi', 'status'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc'); // Optional: tambahkan pengurutan berdasarkan created_at

        return DataTables::of($users)
            ->addColumn('nama', function ($row) {
                return $row->nama ?? '-';
            })
            ->addColumn('jenis_donasi', function ($row) {
                return $row->JenisDonasi->nama ?? '-';
            })
            ->addColumn('aksi', function ($row) {
                // Tambahkan tombol aksi sesuai kebutuhan
                return '<button class="btn-action">Detail</button>';
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }

    // fungsi untuk menolak barang
    public function rejectBarang($id)
    {
        try {
            $barang = DonasiBarang::findOrFail($id);

            DB::transaction(function () use ($barang) {
                $barang->update(['status_verifikasi' => 'rejected']);
            });

            return back()->with('success', 'Barang donasi berhasil ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak barang donasi: ' . $e->getMessage());
        }
    }


    // fungsi untuk menyetujui Donasi
    public function approveDonasi(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        try {
            $donasi = Donasi::findOrFail($id);

            DB::transaction(function () use ($donasi, $request) {
                $namaJenis = strtolower($donasi->JenisDonasi->nama);
                match ($namaJenis) {
                    'dana' => $donasi->DonasiDana()->update(['status_verifikasi' => 'approved']),
                    'barang' => $donasi->DonasiBarang()
                        ->where('status_verifikasi', 'pending')
                        ->update(['status_verifikasi' => 'approved']),
                    'jasa' => $donasi->DonasiJasa()->update(['status_verifikasi' => 'approved']),
                    default => null
                };

                $donasi->update([
                    'status' => 'approved',
                    'alasan' => $request->alasan ?? null
                ]);

                // Kalau mau kirim notifikasi ke user
                $user = $donasi->User ?? null;
                if ($user) {
                    $user->notify(new donasiDiterima($donasi));
                }
            });

            return back()->with('success', 'Donasi berhasil disetujui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyetujui donasi: ' . $e->getMessage());
        }
    }

    // fungsi untuk menolak Donasi
    public function rejectDonasi(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        try {
            $donasi = Donasi::findOrFail($id);

            DB::transaction(function () use ($donasi, $request) {
                $namaJenis = strtolower($donasi->JenisDonasi->nama);

                match ($namaJenis) {
                    'dana' => $donasi->DonasiDana()->update(['status_verifikasi' => 'rejected']),
                    'barang' => $donasi->DonasiBarang()
                        ->update(['status_verifikasi' => 'rejected']),
                    'jasa' => $donasi->DonasiJasa()->update(['status_verifikasi' => 'rejected']),
                    default => null
                };

                $donasi->update([
                    'status' => 'rejected',
                    'alasan' => $request->alasan
                ]);

                // Kalau mau notifikasi
                $user = $donasi->User ?? null;
                if ($user) {
                    $user->notify(new donasiDitolak($donasi));
                }
            });

            return back()->with('success', 'Donasi berhasil ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak donasi: ' . $e->getMessage());
        }
    }


    // fungsi untuk melihat detail donasi
    public function detailDonasi($id)
    {
        $donasi = Donasi::with('Campaign', 'JenisDonasi', 'DonasiBarang', 'DonasiJasa')
            ->findOrFail($id);

        return view('admin.showDetailDonasi', compact('donasi'));
    }
}
