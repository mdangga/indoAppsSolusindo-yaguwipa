<?php

namespace App\Http\Controllers;

use App\Models\KategoriProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class KategoriProgramController extends Controller
{
    // fungsi untuk menampilkan halaman kategori program di admin
    public function index()
    {
        return view('admin.showKategoriProgram');
    }


    // fungsi untuk membuatkan datatable kategori program
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $kategori = KategoriProgram::select(['id_kategori_program', 'nama'])->orderBy('updated_at', 'desc');

        return DataTables::of($kategori)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_kategori_program) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_kategori_program) . '">Hapus</button>
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
        return view('admin.formKategoriProgram');
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $kategori = KategoriProgram::findOrFail($id);
        return view('admin.formKategoriProgram', compact('kategori'));
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
        $data['slug'] = Str::slug($request->nama);

        KategoriProgram::create($data);

        return redirect()->route('admin.kategoriProgram')->with('success', 'Kategori Program berhasil ditambahkan.');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $kategori = KategoriProgram::findOrFail($id);

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
        $data['slug'] = Str::slug($request->nama);

        $kategori->update($data);

        return redirect()->route('admin.kategoriProgram')->with('success', 'Kategori Program berhasil diperbarui.');
    }


    // fungsi untuk menghapus data
    public function destroy($id)
    {
        $jenis = KategoriProgram::findOrFail($id);
        $jenis->delete();

        return redirect()->back()->with('success', 'Kategori Program berhasil dihapus.');
    }
}
