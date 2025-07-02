<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriNewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()
            ->where('status' == 'show')
            ->paginate(8);

        return view('newsandevent', compact('berita'));
    }

    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $berita = Berita::select(['id_berita', 'judul', 'thumbnail', 'status']);

        return DataTables::of($berita)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_berita) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_berita) . '">Hapus</button>
            ';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('thumbnail', function ($row) {
                $path = $row->thumbnail
                    ? asset('storage/' . $row->thumbnail)
                    : asset('images/no-image.png');

                return '<img src="' . e($path) . '" class="w-16 h-16 object-cover rounded" alt="Thumbnail" />';
            })
            ->rawColumns(['aksi', 'thumbnail'])
            ->make(true);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_event,slug',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keyword' => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:show,hide',
            'id_kategori_news_event' => 'required|exists:kategori_news_event,id_kategori_news_event',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        $data['slug'] = Str::slug($request->judul);
        $data['hit'] = 0;
        $data['tanggal_publish'] = $data['status'] === 'show' ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('img/thumbnail-berita', 'public');
            $data['thumbnail'] = $path;
        }

        Berita::create($data);

        return redirect()->route('dashboard')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'show')
            ->firstOrFail();

        $berita->increment('hit');

        return view('berita', compact('berita'));
    }


    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->back()->with('gagal', 'Berita tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_event,slug,' . $berita->id_berita . ',id_berita',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keyword' => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:show,hide',
            'id_kategori_news_event' => 'required|exists:kategori_news_event,id_kategori_news_event',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'judul',
            'meta_title',
            'meta_description',
            'slug',
            'isi_berita',
            'keyword',
            'tanggal_publish',
            'status',
            'id_kategori_news_event',
        ]);

        // Slug pakai generate ulang dari judul
        $data['slug'] = Str::slug($request->judul);

        // Handle upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('img/thumbnail-berita', 'public');
            $data['thumbnail'] = $path;
        } else {
            $data['thumbnail'] = $berita->thumbnail;
        }

        // Tanggal publish jika dipublish sekarang
        if ($request->has('is_dipublish') && $request->is_dipublish && !$berita->is_dipublish) {
            $data['tanggal_publish'] = now();
        }

        $berita->update($data);

        return redirect()->route('dashboard')->with('success', 'Berita berhasil diperbarui!');
    }



    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita not found'
            ], 404);
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita deleted successfully'
        ]);
    }

    // Untuk form store
    public function showFormStore()
    {
        $kategoriList = KategoriNewsEvent::all();
        return view('admin.formBerita', compact('kategoriList'));
    }

    // Untuk form edit
    public function showFormEdit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoriList = KategoriNewsEvent::all();
        return view('admin.formBerita', compact('berita', 'kategoriList'));
    }
}
