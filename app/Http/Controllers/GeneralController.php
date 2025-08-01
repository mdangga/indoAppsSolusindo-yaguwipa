<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\KategoriProgram;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Profiles;
use Illuminate\Support\Facades\Auth;

use App\Models\KategoriNewsEvent;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class GeneralController extends Controller
{
    public function beranda()
    {
        $berita = Berita::with('KategoriNewsEvent')
            ->latest()
            ->where('status', 'show')
            ->take(4)
            ->get();

        $gallery = Gallery::latest()
            ->where('status', 'show')
            ->where('kategori', 'foto')
            ->take(5)
            ->get();

        return view('beranda', compact('berita', 'gallery'));
    }

    public function tentangKami()
    {
        return view('profiles');
    }

    public function testing()
    {
        $kategoriBerita = Cache::remember('berita_per_kategori', now()->addHours(1), function () {
            return KategoriNewsEvent::with(['berita' => function ($query) {
                $query->where('status', 'show')->latest()->take(4);
            }])->get();
        });

        $beritaPopuler = Cache::remember('berita_populer', now()->addHours(1), function () {
            return Berita::orderBy('hit', 'desc')->take(6)->get();
        });

        $startOfRange = Carbon::now()->subDays(7);
        $endOfRange = Carbon::now();

        // Ambil berita populer minggu ini
        $beritaPopulerMingguan = Cache::remember("beritaPopulerMingguan", now()->addHours(1), function () use ($startOfRange, $endOfRange) {
            return Berita::whereBetween('created_at', [$startOfRange, $endOfRange])
                ->where('status', 'show')
                ->orderBy('hit', 'desc')
                ->take(6)
                ->get();
        });
        // dd($berita_populer_mingguan);
        return view('testing3', [
            'kategoriBerita' => $kategoriBerita,
            'beritaPopulerMingguan' => $beritaPopulerMingguan,
            'beritaPopuler' => $beritaPopuler
        ]);
    }

    public function mitra()
    {
        return view('partners');
    }

    public function teams()
    {
        return view('teams');
    }
}
