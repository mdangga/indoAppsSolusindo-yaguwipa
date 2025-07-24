<?php

namespace App\Http\Controllers;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SosiaMediaController extends Controller
{
    // fungsi untuk menampilkan halaman sosial media di admin
    public function index()
    {
        return view('admin.showSosmed');
    }


    // fungsi untuk membuatkan datatable sosial media
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $sosialMedia = SosialMedia::select(['id', 'nama', 'link', 'status'])->orderBy('updated_at', 'desc');

        return DataTables::of($sosialMedia)
            ->addColumn('aksi', function ($row) {
                return '
                <div class="flex items-center">
                <button class="cursor-pointer editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id) . '">Edit</button>
                <button class="cursor-pointer deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id) . '">Hapus</button>
                </div>
            ';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('link', function ($row) {
                return $row->link;
            })
            ->rawColumns(['aksi', 'nama', 'link'])
            ->make(true);
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        return view('admin.formSosmed');
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $sosialMedia = SosialMedia::findOrFail($id);
        return view('admin.formSosmed', compact('sosialMedia'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        SosialMedia::create($data);

        return redirect()->route('admin.sosmed')->with('success', 'Berita berhasil ditambahkan!');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $sosialMedia = SosialMedia::find($id);

        if (!$sosialMedia) {
            return redirect()->back()->with('gagal', 'Sosial Media tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        $sosialMedia->update($data);

        return redirect()->route('admin.sosmed')->with('success', 'sosial media berhasil diedit!');
    }

    
    // fungsi untuk menghapus data
    public function destroy(string $id)
    {
        $sosialMedia = SosialMedia::find($id);

        if (!$sosialMedia) {
            return redirect()->back()->with('gagal', 'Sosial Media tidak ditemukan');
        }

        $sosialMedia->delete();
        return redirect()->route('admin.sosmed')->with('success', 'sosial media berhasil dihapus!');
    }
}