<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::latest()->get();
        return view('gallery', compact('gallery'));
    }

    // menampilkan table di admin
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $gallery = Gallery::select(['id_gallery', 'alt_text', 'kategori', 'link', 'status']);

        return DataTables::of($gallery)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
            <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_gallery) . '">Edit</button>
            <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_gallery) . '">Hapus</button>
        ';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('link', function ($row) {
                if (!$row->link) {
                    return '<img src="' . asset('storage/img/img-placeholder.webp') . '" class="w-16 h-16 object-cover rounded" alt="Placeholder" />';
                }

                $path = asset('storage/' . $row->link);
                $ext = strtolower(pathinfo($row->link, PATHINFO_EXTENSION));

                if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                    return '<video controls width="120" height="80" style="border-radius: 4px;"><source src="' . $path . '" type="video/' . $ext . '">Browser tidak mendukung video.</video>';
                }

                return '<img src="' . $path . '" width="60" height="60" style="border-radius: 4px;" alt="Thumbnail" />';
            })
            ->rawColumns(['aksi', 'link'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.formGaleri');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alt_text' => 'required|string|max:255',
            'kategori' => 'required|in:foto,youtube',
            'status' => 'required|in:show,hide',
            'link' => 'required_if:kategori,foto|file|mimes:jpeg,png,jpg,mp4,webm,ogg|max:10240',
            'youtube_link' => 'required_if:kategori,youtube|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        if ($request->kategori === 'foto' && $request->hasFile('link')) {
            $path = $request->file('link')->store('img/gallery', 'public');
            $data['link'] = $path;
        } elseif ($request->kategori === 'youtube') {
            $data['link'] = $request->youtube_link;
        }

        Gallery::create($data);

        return redirect()->route("admin.gallery")->with('success', 'Gallery berhasil ditambahkan!');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with('gagal', 'Gallery tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'alt_text' => 'required|string|max:255',
            'kategori' => 'required|in:foto,youtube',
            'status' => 'required|in:show,hide',
            'link' => 'nullable|file|mimes:jpeg,png,jpg,mp4,webm,ogg|max:10240',
            'youtube_link' => 'required_if:kategori,youtube|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        if ($request->kategori === 'foto' && $request->hasFile('link')) {
            $path = $request->file('link')->store('img/gallery', 'public');
            $data['link'] = $path;
        } elseif ($request->kategori === 'youtube') {
            $data['link'] = $request->youtube_link;
        } else {
            // Kalau file tidak diupload ulang, pakai yang lama
            $data['link'] = $gallery->link;
        }

        $gallery->update($data);

        return redirect()->route("admin.gallery")->with('success', 'Gallery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return redirect()->back()->with('gagal', 'Gallery tidak ditemukan');
        }

        $gallery->delete();

        return redirect()->back()->with('sukses', 'Gallery berhasil dihapus');
    }

    // Untuk form store
    public function showFormStore()
    {
        return view('admin.formGaleri');
    }

    // Untuk form edit
    public function showFormEdit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.formGaleri', compact('gallery'));
    }
}