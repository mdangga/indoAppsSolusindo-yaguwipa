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
        return view('testing2');
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
