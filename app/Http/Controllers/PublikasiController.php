<?php

namespace App\Http\Controllers;

use App\Models\JenisPublikasi;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PublikasiController extends Controller
{
    // menampilkan halaman publikasi di beranda
    public function show()
    {
        $publikasi = Publikasi::all();
        $jenisPublikasi = JenisPublikasi::all();
        return view('publikasi', compact('publikasi', 'jenisPublikasi'));
    }

    // fungsi untuk membuatkan datatable news dan event
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $publikasi = Publikasi::with('JenisPublikasi')->select(['id_publikasi', 'judul', 'id_jenis_publikasi', 'status'])->orderBy('updated_at', 'desc');

        return DataTables::of($publikasi)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_publikasi) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_publikasi) . '">Hapus</button>
            ';
            })
            ->editColumn('judul', function ($row) {
                return $row->judul;
            })
            ->editColumn('jenis_publikasi', function ($row) {
                return $row->JenisPublikasi->nama;
            })
            ->rawColumns(['aksi', 'jenis_publikasi'])
            ->make(true);
    }


    // fungsi untuk menampilkan halaman publikasi di admin
    public function index()
    {
        return view('admin.showPublikasi');
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        $jenisPublikasi = JenisPublikasi::all();
        return view('admin.formPublikasi', compact('jenisPublikasi'));
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $publikasi = Publikasi::findOrFail($id);
        $jenisPublikasi = JenisPublikasi::all();
        return view('admin.formPublikasi', compact('publikasi', 'jenisPublikasi'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
            'tanggal_terbit' => 'nullable|date',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'id_jenis_publikasi' => 'required|exists:jenis_publikasi,id_jenis_publikasi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validate();


        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('publikasi', 'public');
            $data['file'] = $filePath;
        }

        Publikasi::create($data);

        return redirect()->route('admin.publikasi')->with('success', 'Publikasi berhasil ditambahkan.');
    }


    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240', // tidak wajib
            'tanggal_terbit' => 'nullable|date',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'id_jenis_publikasi' => 'required|exists:jenis_publikasi,id_jenis_publikasi',
            'status' => 'nullable|in:show,hide'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('file')) {
            if ($publikasi->file && Storage::disk('public')->exists($publikasi->file)) {
                Storage::disk('public')->delete($publikasi->file);
            }

            $filePath = $request->file('file')->store('publikasi', 'public');
            $data['file'] = $filePath;
        }

        $publikasi->update($data);

        return redirect()->route('admin.publikasi')->with('success', 'Publikasi berhasil diperbarui.');
    }


    // fungsi untuk menghapus data
    public function destroy($id)
    {
        $publikasi = Publikasi::findOrFail($id);

        if ($publikasi->file && Storage::disk('public')->exists($publikasi->file)) {
            Storage::disk('public')->delete($publikasi->file);
        }

        $publikasi->delete();

        return redirect()->back()->with('success', 'Publikasi berhasil dihapus.');
    }
}
