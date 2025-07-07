<?php

namespace App\Http\Controllers;

use App\Models\KategoriNewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class kategoriNewsEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.showKategoriBerita');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        KategoriNewsEvent::create($data);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // datatable
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $kategori = KategoriNewsEvent::select(['id_kategori_news_event', 'nama', 'deskripsi']);

        return DataTables::of($kategori)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_kategori_news_event) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_kategori_news_event) . '">Hapus</button>
            ';
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('deskripsi', function ($row) {
                return $row->deskripsi;
            })
            
            ->rawColumns(['aksi', 'deskripsi'])
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = KategoriNewsEvent::find($id);
        
        if(!$kategori){
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        $kategori->update($data);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriNewsEvent::find($id);
        
        if(!$kategori){
            return redirect()->back()->with('gagal', 'Kategori tidak ditemukan');
        }

        $kategori->delete();
        return redirect()->back()->with('sukses', 'Kategori berhasil dihapus');
    }

    // Untuk form store
    public function showFormStore()
    {
        return view('admin.formKategoriBerita');
    }

    // Untuk form edit
    public function showFormEdit($id)
    {
        $kategori = KategoriNewsEvent::findOrFail($id);
        return view('admin.formKategoriBerita', compact('kategori'));
    }
}