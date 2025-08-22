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
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        if (strtolower($donasi->JenisDonasi->nama) === 'dana') {
            if($donasi->DonasiDana->status_verifikasi === 'PENDING'){
                return redirect()->away($donasi->DonasiDana->payment_url);
            }else{
                return view('user.detailDonasiUang', compact('donasi'));
            }
        } else {
            return view('user.detailDonasi', compact('donasi'));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email_tlp' => 'required|email',
            'anonim' => 'required|boolean',
            'id_campaign' => 'required|exists:campaign,id_campaign',
            'jenis_donasi' => 'required|string|in:dana,barang,jasa',
            'pesan' => 'nullable|string',
            'nominal' => 'required_if:jenis_donasi,dana|nullable|numeric|min:' . config('xendit.invoice.amount_limits.min') . '|max:' . config('xendit.invoice.amount_limits.max'),
            
            // Barang (multiple)
            'DonasiBarang' => 'required_if:jenis_donasi,barang|nullable|array|min:1',
            'DonasiBarang.*.nama_barang' => 'required_if:jenis_donasi,barang|nullable|string|max:255',
            'DonasiBarang.*.jumlah_barang' => 'required_if:jenis_donasi,barang|nullable|integer|min:1',
            'DonasiBarang.*.kondisi' => 'required_if:jenis_donasi,barang|nullable|in:baru,bekas',
            'DonasiBarang.*.deskripsi' => 'nullable|string',
            
            // Jasa
            'jenis_jasa' => 'required_if:jenis_donasi,jasa|nullable|string|max:255',
            'durasi_jasa' => 'required_if:jenis_donasi,jasa|nullable|string|max:255',
        ]);
        
        
        DB::beginTransaction();
        try {
            $jenis_donasi = JenisDonasi::where('nama', $request->jenis_donasi)->first();
            
            $donasi = Donasi::create([
                'nama' => $request->anonim ? 'Anonymous' : $request->nama,
                'email' => $request->email_tlp,
                'pesan' => $request->pesan,
                'anonim' => $request->anonim,
                'id_user' => auth()->user()->id_user ?? null,
                'id_campaign' => $request->id_campaign,
                'id_jenis_donasi' => $jenis_donasi->id_jenis_donasi,
                'status' => 'pending'
            ]);
            
            if ($request->jenis_donasi == 'dana') {
                try {
                    // dd($donasi->Campaign->slug);
                    $xenditService = new XenditService();
                    $invoice = $xenditService->createInvoice(
                        externalId: 'donasi-' . $donasi->id_donasi,
                        amount: (float) $request->nominal,
                        payerEmail: $request->email_tlp,
                        description: "Donasi untuk campaign: " . $donasi->Campaign->nama,
                        customerName: $request->nama,
                        slugCampaign: $donasi->Campaign->slug,
                        invoiceDuration: config('xendit.invoice.expiry_duration', 86400),
                        paymentMethods: config('xendit.payment-method'),
                    );
                    
                    // dd($invoice);
                    DonasiDana::create([
                        'id_donasi' => $donasi->id_donasi,
                        'nominal' => $request->nominal,
                        'payment_id' => $invoice['id'],
                        'payment_url' => $invoice['invoice_url'],
                        'status_verifikasi' => strtoupper($invoice['status']),
                        'expired_at' => $invoice['expiry_date'],
                    ]);
                    

                    DB::commit();
                    if (isset($invoice['invoice_url']) && !empty($invoice['invoice_url'])) {
                        return redirect()->away($invoice['invoice_url']);
                    } else {
                        Log::error('Xendit invoice_url missing:', (array) $invoice);
                        return back()->withErrors(['error' => 'Payment URL tidak tersedia']);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Donasi Error: ' . $e->getMessage());
                    return back()->withErrors(['error' => 'Failed to process payment: ' . $e->getMessage()]);
                }
            }

            if ($request->jenis_donasi == 'barang') {
                foreach ($request->DonasiBarang as $item) {
                    DonasiBarang::create([
                        'id_donasi' => $donasi->id_donasi,
                        'nama_barang' => $item['nama_barang'],
                        'jumlah_barang' => $item['jumlah_barang'] ?? 1,
                        'deskripsi' => $item['deskripsi'] ?? null,
                        'kondisi' => $item['kondisi'] ?? 'baru',
                        'status_verifikasi' => 'pending'
                    ]);
                }
            }

            if ($request->jenis_donasi == 'jasa') {
                DonasiJasa::create([
                    'id_donasi' => $donasi->id_donasi,
                    'jenis_jasa' => $request->jenis_jasa,
                    'durasi_jasa' => $request->durasi_jasa,
                    'status_verifikasi' => 'pending'
                ]);
            }

            // Send notification
            $pengajuanNotif = [
                'nama' => $request->nama,
                'jenis_donasi' => $jenis_donasi->nama,
                'id' => $donasi->id_donasi,
            ];

            $adminUsers = \App\Models\User::where('role', 'admin')->get();
            Notification::send($adminUsers, new NotifikasiPengajuanDonasi($pengajuanNotif));

            DB::commit();
            return redirect()->route('campaign.slug', $donasi->campaign->slug)
                ->with('success', 'Pengajuan donasi berhasil dibuat. Silakan tunggu verifikasi dari admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal membuat donasi: ' . $e->getMessage()]);
        }
    }

    // fungsi untuk menyetujui barang
    public function approveBarang($id)
    {
        try {
            $barang = DonasiBarang::findOrFail($id);

            DB::transaction(function () use ($barang) {
                $barang->update(['status_verifikasi' => 'approved']);
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
                    'alasan' => $request->alasan ?? null,
                    'approved_at' => now(),
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
                    'dana' => $donasi->DonasiDana()->update(['status_verifikasi' => 'VOIDED', 'paid_at' => now()]),
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

    public function success($slug)
    {
        return redirect()->route('campaign.slug', $slug)->with('success', 'Pembayaran Berhasil!');
    }

    public function failure($slug)
    {
        return redirect()->route('campaign.slug', $slug)->with('failed', 'Pembayaran Gagal!');
    }
}
