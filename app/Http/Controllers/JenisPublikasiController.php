<?php

namespace App\Http\Controllers;

use App\Models\JenisPublikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JenisPublikasiController extends Controller
{
    // fungsi untuk menampilkan halaman jenis publikasi di admin
    public function index()
    {
        return view('admin.showJenisPublikasi');
    }


    // fungsi untuk membuatkan datatable jenis publikasi
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $jenis = JenisPublikasi::select(['id_jenis_publikasi', 'nama'])->orderBy('updated_at', 'desc');

        return DataTables::of($jenis)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_jenis_publikasi) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_jenis_publikasi) . '">Hapus</button>
            ';
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->rawColumns(['aksi', 'nama'])
            ->make(true);
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        return view('admin.formJenisPublikasi');
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $jenis_publikasi = JenisPublikasi::findOrFail($id);
        return view('admin.formJenisPublikasi', compact('jenis_publikasi'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:jenis_publikasi,nama|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validate();

        JenisPublikasi::create($data);

        return redirect()->route('admin.berita')->with('success', 'Jenis publikasi berhasil ditambahkan.');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $jenis = JenisPublikasi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:jenis_publikasi,nama|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validate();

        $jenis->update($data);

        return redirect()->route('admin.jenisPublikasi')->with('success', 'Jenis publikasi berhasil ditambahkan.');
    }


    // fungsi untuk menghapus data
    public function destroy($id)
    {
        $jenis = JenisPublikasi::findOrFail($id);
        $jenis->delete();

        return redirect()->back()->with('success', 'Jenis publikasi berhasil dihapus.');
    }
}
