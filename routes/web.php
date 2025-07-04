<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// testing area
Route::get('/testing', function () {
    return view('admin.showGaleri');
})->name('testing');
Route::post('/profiles/create', [ProfileController::class, 'store'])->name('profiles.store');

// default route
Route::get('/', [GeneralController::class, 'beranda'])->name('beranda');

// news & event 
Route::get('/berita-dan-kegiatan', [BeritaController::class, 'index'])->name('beranda.berita');
Route::get('/berita/show/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// gallery
Route::get('/gallery/show-all', [GalleryController::class, 'index'])->name('beranda.gallery');

// middleware authtentication
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'me'])->name('dashboard');
    // gallery
    Route::get('/gallery', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
    Route::get('/datatable/gallery', [GalleryController::class, 'getDataTables'])->name('gallery.table');
    Route::get('/gallery/store', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'showFormEdit'])->name('gallery.formEdit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy']);
    // news & event 
    Route::get('/datatable/berita', [BeritaController::class, 'getDataTables'])->name('berita.table');
    Route::get('/berita/store', [BeritaController::class, 'showFormStore'])->name('berita.formStore');
    Route::get('/berita/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/destroy/{id}', [BeritaController::class, 'destroy']);

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
