<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Institusi;
use App\Models\Mitra;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

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

        $reviewPositif = Review::with('User')
            ->where('rating', '>=', '4')
            ->latest()
            ->where('status', 'show')
            ->take(6)
            ->get();
        $reviewKritis = Review::with('User')
            ->where('rating', '<=', '2')
            ->latest()
            ->where('status', 'show')
            ->take(6)
            ->get();

        $reviews = $reviewPositif->merge($reviewKritis)->sortByDesc('created_at');

        return view('beranda', compact('berita', 'gallery', 'reviews'));
    }

    public function tentangKami()
    {
        return view('profiles');
    }

    public function testing($id) {}

    public function partner()
    {
        $mitra = Cache::remember('mitra_all', 60, function () {
            return User::where('role', 'mitra')
                ->select('nama', 'profile_path')
                ->get();
        });

        $institusi = Cache::remember('institusi_all', 60, function () {
            return Institusi::select('nama', 'profile_path')->get();
        });

        $partners = $mitra->concat($institusi)->sortBy('nama')->values();
        // dd($partners);
        return view('partners', compact('partners'));
    }

    public function teams()
    {
        return view('notification');
    }
}
