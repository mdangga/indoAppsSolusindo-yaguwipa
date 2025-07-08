<?php

namespace App\Http\Controllers;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SosiaMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.showSosmed');
    }

    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $sosialMedia = SosialMedia::select(['id', 'nama', 'link', 'status']);

        return DataTables::of($sosialMedia)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id) . '">Hapus</button>
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sosialMedia = SosialMedia::find($id);

        if (!$sosialMedia) {
            return redirect()->back()->with('gagal', 'Sosial Media tidak ditemukan');
        }

        $sosialMedia->delete();
        return redirect()->route('admin.sosmed')->with('success', 'sosial media berhasil dihapus!');
    }

    // Untuk form store
    public function showFormStore()
    {
        return view('admin.formSosmed');
    }

    // Untuk form edit
    public function showFormEdit($id)
    {
        $sosialMedia = SosialMedia::findOrFail($id);
        return view('admin.formSosmed', compact('sosialMedia'));
    }
}