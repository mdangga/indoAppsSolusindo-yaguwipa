<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KerjaSama;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Review;

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

    public function testing($id)
    {

    }
    public function mitra()
    {
        return view('partners');
    }

    public function teams()
    {
        return view('notification');
    }
}
