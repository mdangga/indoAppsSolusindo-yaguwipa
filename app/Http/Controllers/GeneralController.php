<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function beranda()
    {
        $berita = Berita::where('is_dipublish', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();
        $gallery = Gallery::orderBy('created_at', 'desc')->take(5)->get();
        return view('beranda', compact('berita', 'gallery'));
    }
}
