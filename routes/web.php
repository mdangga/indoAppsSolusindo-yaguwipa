<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BeritaController::class, 'beranda'])->name('beranda');

Route::get('/testing', function () {
    return view('testing');
});

Route::get('/gallery', [GalleryController::class, 'index'])->name('beranda');

Route::post('/galeri', [GalleryController::class, 'store'])->name('galeri.store');
// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (setelah login)
Route::get('/dashboard', [AuthController::class, 'me'])->middleware('auth')->name('dashboard');
Route::get('/berita/create', function () {
    return view('testing');
});
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita', [BeritaController::class, 'store']);
Route::put('/berita/{id}', [BeritaController::class, 'update']);
Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);