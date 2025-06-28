<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BeritaController::class, 'beranda'])->name('beranda');

Route::get('/berita/create', function () {
    return view('testing');
});

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);
Route::post('/berita', [BeritaController::class, 'store']);
Route::put('/berita/{id}', [BeritaController::class, 'update']);
Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);

Route::get('/berita', [BeritaController::class, 'index'])->name('berandaberita');

Route::get('/signin', function () {
    return view('signin');
});