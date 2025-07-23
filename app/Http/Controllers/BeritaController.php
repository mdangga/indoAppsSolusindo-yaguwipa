<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriNewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    // menampilkan halaman news dan event di beranda
    public function show()
    {
        $page = request('page', 1);

        $berita = Cache::remember("berita_page_{$page}", now()->addHours(1), function () {
            return Berita::latest()
                ->where('status', 'show')
                ->paginate(8);
        });

        $kategoriBerita = Cache::remember('berita_per_kategori', now()->addHours(1), function () {
            return KategoriNewsEvent::with(['berita' => function ($query) {
                $query->where('status', 'show')->latest()->take(4);
            }])->get();
        });

        return view('newsandevent', [
            'berita' => $berita,
            'kategoriBerita' => $kategoriBerita
        ]);
    }

    // menampilkan halaman news dan event hanya keyword di beranda
    public function showKeyword($keyword)
    {
        // Normalisasi keyword dari URL: hilangkan encoding dan spasi tambahan
        $keyword = strtolower(trim(urldecode($keyword)));

        // Query dengan padding ";" agar pencarian akurat
        $keywords = Berita::whereRaw("REPLACE(LOWER(CONCAT(';', keyword, ';')), ' ', '') LIKE ?", [
            "%;" . str_replace(' ', '', $keyword) . ";%"
        ])->get();

        return view('newsandevent', [
            'keywords' => $keywords
        ]);
    }




    // fungsi untuk menampilkan halaman berita untuk setiap slug di beranda
    public function showSlug($slug)
    {
        $berita = Cache::remember("berita_detail_{$slug}", now()->addHours(1), function () use ($slug) {
            Log::info('newsslug dari DB');
            return Berita::where('slug', $slug)
                ->where('status', 'show')
                ->firstOrFail();
        });

        $berita->increment('hit');

        $berita_populer = Cache::remember('berita_populer', now()->addHours(1), function () {
            return Berita::orderBy('hit', 'desc')->take(5)->get();
        });

        $berita_terkait = Cache::remember("berita_terkait_{$berita->id_berita}", now()->addHours(1), function () use ($berita) {
            return Berita::where('id_kategori_news_event', $berita->id_kategori_news_event)
                ->where('id_berita', '!=', $berita->id_berita)
                ->where('status', 'show')
                ->latest()
                ->take(4)
                ->get();
        });

        return view('berita', compact('berita', 'berita_populer', 'berita_terkait'));
    }


    // fungsi untuk menampilkan halaman news dan event di admin
    public function index()
    {
        return view('admin.showBerita');
    }


    // fungsi untuk membuatkan datatable news dan event
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $berita = Berita::select(['id_berita', 'judul', 'thumbnail', 'status'])->orderBy('updated_at', 'desc');

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


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        $kategoriList = KategoriNewsEvent::all();
        return view('admin.formBeritaNew', compact('kategoriList'));
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoriList = KategoriNewsEvent::all();
        return view('admin.formBeritaNew', compact('berita', 'kategoriList'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:2000',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'caption' => 'nullable|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:show,hide',
            'hit' => 'required|numeric|min:0',
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

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'img/thumbnail-berita/' . uniqid() . '.webp';

            $img = Image::read($image)
                ->toWebp(80);
            Storage::disk('public')->put($filename, $img);
            $data['thumbnail'] = $filename;
        }

        $berita = Berita::create($data);
        $berita->clearCache();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan!');
    }

    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->back()->with('gagal', 'Berita tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:2000',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'caption' => 'nullable|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:show,hide',
            'hit' => 'required|numeric|min:0',
            'id_kategori_news_event' => 'required|exists:kategori_news_event,id_kategori_news_event',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $request->only([
            'judul',
            'meta_title',
            'meta_description',
            'caption',
            'isi_berita',
            'keyword',
            'tanggal_publish',
            'status',
            'hit',
            'id_kategori_news_event',
        ]);

        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'img/thumbnail-berita/' . uniqid() . '.webp';

            $img = Image::read($image)
                ->toWebp(80);

            Storage::disk('public')->put($filename, $img);
            $data['thumbnail'] = $filename;
        } else {
            $data['thumbnail'] = $berita->thumbnail;
        }


        if ($request->has('status') && $request->status && !$berita->status) {
            $data['tanggal_publish'] = now();
        }

        $berita->update($data);
        $berita->clearCache();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui!');
    }

    // fungsi untuk menghapus data
    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->back()->with('gagal', 'Berita tidak ditemukan');
        }

        $berita->delete();
        $berita->clearCache();

        return redirect()->back()->with('sukses', 'Berita berhasil dihapus');
    }
}
