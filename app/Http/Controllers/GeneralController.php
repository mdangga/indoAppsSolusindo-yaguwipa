<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Profiles;

class GeneralController extends Controller
{
    public function beranda()
    {
        $berita = Berita::latest()
            ->where('status', 'show')
            ->take(4)
            ->get();
        
        $gallery = Gallery::orderBy('created_at', 'desc')->take(5)->get();
        return view('beranda', compact('berita', 'gallery'));
    }

    public function tentangKami(){
        return view('profiles');
    }
}