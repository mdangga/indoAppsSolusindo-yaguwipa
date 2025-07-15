<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function berandaShow()
    {
        $gallery = Gallery::latest()->get();
        return view('gallery', compact('gallery'));
    }

    public function adminShow()
    {
        return view('admin.showGallery');
    }

    // menampilkan table di admin
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $gallery = Gallery::select(['id_gallery', 'alt_text', 'kategori', 'link', 'status'])->orderBy('updated_at', 'desc');

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
                    return null; // atau bisa kembalikan URL /img/no-image.png
                }

                $ext = strtolower(pathinfo($row->link, PATHINFO_EXTENSION));

                // Jika kategori YouTube
                if ($row->kategori === 'youtube') {
                    // Ambil ID YouTube dari URL
                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $row->link, $matches)) {
                        $youtubeId = $matches[1];
                        return "https://img.youtube.com/vi/{$youtubeId}/mqdefault.jpg";
                    }
                }

                // Jika gambar yang diupload
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    return asset('storage/' . $row->link);
                }

                return null;
            })


            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'alt_text' => 'required|string|max:255',
            'kategori' => 'required|in:foto,youtube',
            'status' => 'required|in:show,hide',
        ];

        if ($request->kategori === 'foto') {
            $rules['link'] = 'required:kategori,foto|file|mimes:jpeg,png,jpg,webp|max:10240';
        } elseif ($request->kategori === 'youtube') {
            $rules['youtube_link'] = 'required:kategori,youtube|url';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = [
            'alt_text' => $request->alt_text,
            'kategori' => $request->kategori,
            'status' => $request->status,
        ];

        if ($request->kategori === 'foto' && $request->hasFile('link')) {
            $path = $request->file('link')->store('img/gallery', 'public');
            $data['link'] = $path;
        } elseif ($request->kategori === 'youtube' && $request->youtube_link) {
            $data['link'] = $request->youtube_link;
        } else {
            return redirect()->back()
                ->withInput()
                ->with('message', 'File atau link YouTube wajib diisi.');
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery')->with('success', 'Gallery berhasil ditambahkan!');
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

        $rules = [
            'alt_text' => 'required|string|max:255',
            'kategori' => 'required|in:foto,youtube',
            'status' => 'required|in:show,hide',
        ];

        if ($request->kategori === 'foto') {
            if ($gallery->kategori === 'youtube' || !$gallery->link) {
                $rules['link'] = 'required|file|mimes:jpeg,png,jpg,webp|max:10240';
            } else {
                $rules['link'] = 'nullable|file|mimes:jpeg,png,jpg,webp|max:10240';
            }
        } elseif ($request->kategori === 'youtube') {
            $rules['youtube_link'] = 'required|url';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = [
            'alt_text' => $request->alt_text,
            'kategori' => $request->kategori,
            'status' => $request->status,
        ];

        if ($request->kategori === 'foto') {
            if ($request->hasFile('link')) {
                if ($gallery->link && Storage::disk('public')->exists($gallery->link)) {
                    Storage::disk('public')->delete($gallery->link);
                }

                $path = $request->file('link')->store('img/gallery', 'public');
                $data['link'] = $path;
            } elseif ($gallery->kategori === 'youtube' && !$request->hasFile('link')) {
                return redirect()->back()
                    ->withInput()
                    ->with('message', 'File foto wajib diisi ketika mengubah dari YouTube ke Foto.');
            }
        } elseif ($request->kategori === 'youtube' && $request->youtube_link) {
            if ($gallery->kategori === 'foto' && $gallery->link && Storage::disk('public')->exists($gallery->link)) {
                Storage::disk('public')->delete($gallery->link);
            }

            $data['link'] = $request->youtube_link;
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery')->with('success', 'Gallery berhasil diperbarui!');
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
        return view('admin.formGallery');
    }

    // Untuk form edit
    public function showFormEdit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.formGallery', compact('gallery'));
    }
}