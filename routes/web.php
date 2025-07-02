<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

// testing area
Route::get('/', [GeneralController::class, 'beranda'])->name('beranda');
Route::get('/testing1', function () {
    return view('admin.berita');
});
Route::get('/testing2', function () {
    return view('partners');
});
Route::get('/testing3', function () {
    return view('kegiatan');
});

// news & event 
Route::get('/berita-dan-kegiatan', [BeritaController::class, 'index'])->name('beranda.berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('beranda.gallery');

// middleware authtentication
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'me'])->name('dashboard');
    // gallery
    // news & event 
    Route::get('/datatable/berita', [BeritaController::class, 'getDataTables'])->name('berita.table');
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth routes
// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);