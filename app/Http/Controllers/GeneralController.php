<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KerjaSama;
use Illuminate\Pagination\LengthAwarePaginator;

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
