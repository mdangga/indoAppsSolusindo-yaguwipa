<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\kategoriNewsEventController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SosiaMediaController;
use Illuminate\Support\Facades\Route;

// testing area
Route::get('/testing', [GeneralController::class, 'testing'])->name('testing');


// route
Route::get('/', [GeneralController::class, 'beranda'])->name('beranda');
// profiles
Route::get('/tentang-kami', [GeneralController::class, 'tentangKami'])->name('beranda.tentang');
// news & event 
Route::get('/berita-dan-kegiatan', [BeritaController::class, 'index'])->name('beranda.berita');
Route::get('/berita/show/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// gallery
Route::get('/gallery/show-all', [GalleryController::class, 'berandaShow'])->name('beranda.gallery');

// teams
Route::get('/teams', [GeneralController::class, 'teams'])->name('beranda.teams');


// partners
Route::get('/mitra', [GeneralController::class, 'mitra'])->name('beranda.mitra');

// middleware authtentication
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'me'])->name('dashboard');
    Route::get('/kategori', [kategoriNewsEventController::class, 'index'])->name('admin.kategori');
    Route::get('/gallery', [GalleryController::class, 'adminShow'])->name('admin.gallery');
    Route::get('/menus', [MenusController::class, 'index'])->name('admin.menus');
    Route::get('/sosial-media', [SosiaMediaController::class, 'index'])->name('admin.sosmed');
    
    
    // general setting
    Route::get('/general-setting', [ProfileController::class, 'index'])->name('admin.profiles');
    Route::put('/general-setting/update/{id}', [ProfileController::class, 'update'])->name('profiles.update');
    // sosial media
    Route::get('/datatable/sosial-media', [SosiaMediaController::class, 'getDataTables'])->name('sosmed.table');
    Route::get('/sosial-media/store', [SosiaMediaController::class, 'showFormStore'])->name('sosmed.formStore');
    Route::post('/sosial-media', [SosiaMediaController::class, 'store'])->name('sosmed.store');
    Route::get('/sosial-media/edit/{id}', [SosiaMediaController::class, 'showFormEdit'])->name('sosmed.formEdit');
    Route::put('/sosial-media/{id}', [SosiaMediaController::class, 'update'])->name('sosmed.update');
    Route::delete('/sosial-media/destroy/{id}', [SosiaMediaController::class, 'destroy'])->name('sosmed.delete');
    // gallery
    Route::get('/datatable/gallery', [GalleryController::class, 'getDataTables'])->name('gallery.table');
    Route::get('/gallery/store', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'showFormEdit'])->name('gallery.formEdit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    // Kategori
    Route::get('/kategori-news-event', [kategoriNewsEventController::class, 'index'])->name('admin.kategoriBerita');
    Route::get('/datatable/kategori-news-event', [kategoriNewsEventController::class, 'getDataTables'])->name('kategori.table');
    Route::get('/kategori/store', [kategoriNewsEventController::class, 'showFormStore'])->name('kategori.formStore');
    Route::get('/kategori/edit/{id}', [kategoriNewsEventController::class, 'showFormEdit'])->name('kategori.formEdit');
    Route::post('/kategori', [kategoriNewsEventController::class, 'create'])->name('kategori.store');
    Route::put('/kategori/{id}', [kategoriNewsEventController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}', [kategoriNewsEventController::class, 'destroy'])->name('kategori.delete');
    // news & event 
    Route::get('/datatable/berita', [BeritaController::class, 'getDataTables'])->name('berita.table');
    Route::get('/berita/store', [BeritaController::class, 'showFormStore'])->name('berita.formStore');
    Route::get('/berita/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/destroy/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');
    // menus
    Route::get('/datatable/menus', [MenusController::class, 'getDataTables'])->name('menus.table');
    Route::get('/menu/store', [MenusController::class, 'showFormStore'])->name('menus.formStore');
    Route::get('/menu/edit/{id}', [MenusController::class, 'showFormEdit'])->name('menus.formEdit');
    Route::post('/menu', [MenusController::class, 'store'])->name('menus.store');
    Route::put('/menu/{id}', [MenusController::class, 'update'])->name('menus.update');
    Route::delete('/menu/destroy/{id}', [MenusController::class, 'destroy'])->name('berita.delete');
    


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