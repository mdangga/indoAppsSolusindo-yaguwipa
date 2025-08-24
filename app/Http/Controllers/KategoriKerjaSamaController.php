<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerjaSama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriKerjaSamaController extends Controller
{
    // fungsi untuk menampilkan halaman kategori program di admin
    public function index()
    {
        return view('admin.showKategoriKerjaSama');
    }


    // fungsi untuk membuatkan datatable kategori program
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $kategori = KategoriKerjaSama::select(['id_kategori_kerja_sama', 'nama'])->orderBy('updated_at', 'desc');

        return DataTables::of($kategori)
            ->addColumn('aksi', function ($row) {
                return '
                <div class="flex items-center">
                <button class="cursor-pointer editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_kategori_kerja_sama) . '">Edit</button>
                <button class="cursor-pointer deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_kategori_kerja_sama) . '">Hapus</button>
                </div>
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
        return view('admin.formKategoriKerjaSama');
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $kategori = kategoriKerjaSama::findOrFail($id);
        return view('admin.formKategoriKerjaSama', compact('kategori'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:kategori_kerja_sama,nama|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validate();

        KategoriKerjaSama::create($data);

        return redirect()->route('admin.kategoriKerjaSama')->with('success', 'Kategori Kerja Sama berhasil ditambahkan.');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $kategori = KategoriKerjaSama::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:kategori_kerja_sama,nama|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validate();

        $kategori->update($data);

        return redirect()->route('admin.kategoriKerjaSama')->with('success', 'Kategori Kerja Sama berhasil diperbarui.');
    }


    // fungsi untuk menghapus data
    public function destroy($id)
    {
        $jenis = KategoriKerjaSama::findOrFail($id);
        $jenis->delete();

        return redirect()->back()->with('success', 'Kategori Kerja Sama berhasil dihapus.');
    }
}
