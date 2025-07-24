<?php

namespace App\Http\Controllers;

use App\Models\KategoriNewsEvent;
use App\Models\KategoriProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class kategoriNewsEventController extends Controller
{
    // fungsi untuk menampilkan halaman kategori news dan event di admin
    public function index()
    {
        return view('admin.showKategoriBerita');
    }


    // fungsi untuk membuatkan datatable kategori news dan event
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $kategori = KategoriNewsEvent::with('KategoriProgram')
            ->select(['id_kategori_news_event', 'nama', 'id_kategori_program'])
            ->orderBy('updated_at', 'desc');


        return DataTables::of($kategori)
            ->addColumn('aksi', function ($row) {
                return '
                <div class="flex items-center">
                <button class="cursor-pointer editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_kategori_news_event) . '">Edit</button>
                <button class="cursor-pointer deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_kategori_news_event) . '">Hapus</button>
            ';
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('kategori_program', function ($row) {
                return optional($row->KategoriProgram)->nama ?? 'Tidak ada';
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        $program = KategoriProgram::all();
        return view('admin.formKategoriBerita', compact('program'));
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $kategori = KategoriNewsEvent::findOrFail($id);
        $program = KategoriProgram::all();
        return view('admin.formKategoriBerita', compact('kategori', 'program'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        KategoriNewsEvent::create($data);

        return redirect()->route('admin.kategoriBerita')->with('success', 'Kategori berhasil ditambahkan!');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kategori = KategoriNewsEvent::find($id);

        if (!$kategori) {
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        $kategori->update($data);

        return redirect()->route('admin.kategoriBerita')->with('success', 'Kategori berhasil ditambahkan!');
    }


    // fungsi untuk menghapus data
    public function destroy(string $id)
    {
        $kategori = KategoriNewsEvent::find($id);

        if (!$kategori) {
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan');
        }

        $kategori->delete();
        return redirect()->back()->with('sukses', 'Kategori berhasil dihapus');
    }
}
