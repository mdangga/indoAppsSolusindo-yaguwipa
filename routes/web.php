<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\kategoriNewsEventController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SosiaMediaController;
use Illuminate\Support\Facades\Route;

// testing area
Route::get('/testing', [GeneralController::class, 'testing'])->name('testing');


// route default
Route::get('/', [GeneralController::class, 'beranda'])->name('beranda');

// profiles
Route::get('/tentang-kami', [GeneralController::class, 'tentangKami'])->name('beranda.tentang');

// news & event 
Route::get('/berita-dan-kegiatan/show-all', [BeritaController::class, 'show'])->name('beranda.berita');
Route::get('/berita-dan-kegiatan/show/{slug}', [BeritaController::class, 'showSlug'])->name('berita.slug');

// gallery
Route::get('/gallery/show-all', [GalleryController::class, 'show'])->name('beranda.gallery');

// teams
Route::get('/teams', [GeneralController::class, 'teams'])->name('beranda.teams');//perbaiki

// partners
Route::get('/mitra', [GeneralController::class, 'mitra'])->name('beranda.mitra');//perbaiki

// middleware authtentication
Route::middleware(['auth.admin'])->group(function () {    
    // general setting
    Route::get('/general-setting', [ProfileController::class, 'index'])->name('admin.profiles');
    Route::put('/general-setting/update/{id}', [ProfileController::class, 'update'])->name('profiles.update');
    
    
    // sosial media
    Route::get('/sosial-media', [SosiaMediaController::class, 'index'])->name('admin.sosmed');
    Route::get('/datatable/sosial-media', [SosiaMediaController::class, 'getDataTables'])->name('sosmed.table');
    
    Route::get('/sosial-media/store', [SosiaMediaController::class, 'showFormStore'])->name('sosmed.formStore');
    Route::post('/sosial-media', [SosiaMediaController::class, 'store'])->name('sosmed.store');
    
    Route::get('/sosial-media/edit/{id}', [SosiaMediaController::class, 'showFormEdit'])->name('sosmed.formEdit');
    Route::put('/sosial-media/{id}', [SosiaMediaController::class, 'update'])->name('sosmed.update');
    
    Route::delete('/sosial-media/destroy/{id}', [SosiaMediaController::class, 'destroy'])->name('sosmed.delete');
    
    
    // program (under constructions)
    Route::get('/program', [ProgramController::class, 'create'])->name('');
    Route::post('/program', [ProgramController::class, 'store'])->name('program.store');
    
    
    // gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
    Route::get('/datatable/gallery', [GalleryController::class, 'getDataTables'])->name('gallery.table');
    
    Route::get('/gallery/store', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'showFormEdit'])->name('gallery.formEdit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    
    Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    
    
    // Kategori-news-event
    Route::get('/kategori-news-event', [kategoriNewsEventController::class, 'index'])->name('admin.kategoriBerita');
    Route::get('/datatable/kategori-news-event', [kategoriNewsEventController::class, 'getDataTables'])->name('kategoriBerita.table');
    
    Route::get('/kategori-news-event/store', [kategoriNewsEventController::class, 'showFormStore'])->name('kategoriBerita.formStore');
    Route::post('/kategori-news-event', [kategoriNewsEventController::class, 'store'])->name('kategoriBerita.store');
    
    Route::get('/kategori-news-event/edit/{id}', [kategoriNewsEventController::class, 'showFormEdit'])->name('kategoriBerita.formEdit');
    Route::put('/kategori-news-event/{id}', [kategoriNewsEventController::class, 'update'])->name('kategoriBerita.update');
    
    Route::delete('/kategori-news-event/destroy/{id}', [kategoriNewsEventController::class, 'destroy'])->name('kategoriBerita.delete');
    
    
    // news & event 
    Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::get('/datatable/berita', [BeritaController::class, 'getDataTables'])->name('berita.table');

    Route::get('/berita/store', [BeritaController::class, 'showFormStore'])->name('berita.formStore');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    
    Route::get('/berita/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    
    Route::delete('/berita/destroy/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');
    
    
    // menus
    Route::get('/menus', [MenusController::class, 'index'])->name('admin.menus');
    Route::get('/datatable/menus', [MenusController::class, 'getDataTables'])->name('menus.table');
    
    Route::get('/menus/store', [MenusController::class, 'showFormStore'])->name('menus.formStore');
    Route::post('/menus', [MenusController::class, 'store'])->name('menus.store');
    
    Route::get('/menus/edit/{id}', [MenusController::class, 'showFormEdit'])->name('menus.formEdit');
    Route::put('/menus/{id}', [MenusController::class, 'update'])->name('menus.update');
    
    Route::delete('/menus/destroy/{id}', [MenusController::class, 'destroy'])->name('berita.delete');
    
    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth routes
// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// personalDataUser
Route::get('/register/{id}', [AuthController::class, 'showFormUser'])->name('register.dataUser');
Route::post('/add-data-user', [AuthController::class, 'addDataUser'])->name('add.dataUser');


// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);