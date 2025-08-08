<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiBarang;
use App\Models\DonasiDana;
use App\Models\DonasiJasa;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    public function show()
    {
        return view('formDonasi');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email',
            'anonim'          => 'required|boolean',
            'id_campaign'     => 'required|exists:campaign,id_campaign',
            'id_jenis_donasi' => 'required|in:1,2,3',
            'pesan'           => 'nullable|string',

            // Dana
            // 'nominal'         => 'required_if:id_jenis_donasi,1|numeric|min:1',

            // Barang (multiple)
            'barang'                  => 'required_if:id_jenis_donasi,2|array|min:1',
            'barang.*.nama_barang'    => 'required_if:id_jenis_donasi,2|string|max:255',
            'barang.*.jumlah_barang'  => 'required_if:id_jenis_donasi,2|integer|min:1',
            'barang.*.kondisi'        => 'required_if:id_jenis_donasi,2|in:baru,bekas',
            'barang.*.deskripsi'      => 'nullable|string',

            // Jasa
            'jenis_jasa'      => 'required_if:id_jenis_donasi,3|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('file_penunjang'))
                ->with('error', 'Terdapat kesalahan dalam pengisian form');
        }

        DB::beginTransaction();
        try {
            // 1. Simpan data umum donasi
            $donasi = Donasi::create([
                'nama'            => $request->nama,
                'email'           => $request->email,
                'pesan'           => $request->pesan,
                'anonim'          => $request->anonim,
                'id_user'         => auth()->user->id_user,
                'id_campaign'     => $request->id_campaign,
                'id_jenis_donasi' => $request->id_jenis_donasi
            ]);

            // 2. Simpan detail sesuai jenis donasi
            switch ($request->id_jenis_donasi) {
                case 1: // Dana
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
                    break;

                case 2: // Barang (multiple insert)
                    foreach ($request->barang as $item) {
                        DonasiBarang::create([
                            'id_donasi'         => $donasi->id_donasi,
                            'nama_barang'       => $item['nama_barang'],
                            'jumlah_barang'     => $item['jumlah_barang'],
                            'deskripsi'         => $item['deskripsi'] ?? null,
                            'kondisi'           => $item['kondisi'],
                            'status_verifikasi' => 'pending'
                        ]);
                    }
                    break;

                case 3: // Jasa
                    DonasiJasa::create([
                        'id_donasi'         => $donasi->id_donasi,
                        'jenis_jasa'        => $request->jenis_jasa,
                        'durasi_jasa'       => $request->durasi_jasa,
                        'status_verifikasi' => 'pending'
                    ]);
                    break;
            }

            DB::commit();

            return response()->json([
                'message' => 'Donasi berhasil dibuat',
                'data'    => $donasi->load(['barang', 'jasa', 'dana'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal membuat donasi',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
