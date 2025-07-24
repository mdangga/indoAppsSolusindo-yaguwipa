<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JenisPublikasiController;
use App\Http\Controllers\kategoriNewsEventController;
use App\Http\Controllers\KategoriProgramController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\SosiaMediaController;
use Illuminate\Support\Facades\Route;

// testing-area
Route::get('/testing', [GeneralController::class, 'testing'])->name('testing');


// route-default
Route::get('/', [GeneralController::class, 'beranda'])->name('beranda');

// profiles
Route::get('/tentang-kami', [GeneralController::class, 'tentangKami'])->name('beranda.tentang');

// news-dan-event 
Route::get('/berita-dan-kegiatan/show-all', [BeritaController::class, 'show'])->name('beranda.berita');
Route::get('/berita-dan-kegiatan/show/{slug}', [BeritaController::class, 'showSlug'])->name('berita.slug');
Route::get('/berita-dan-kegiatan/show-all/keyword/{keyword}', [BeritaController::class, 'showKeyword'])->name('berita.keyword');

// gallery
Route::get('/gallery/show-all', [GalleryController::class, 'show'])->name('beranda.gallery');

// teams
Route::get('/teams', [GeneralController::class, 'teams'])->name('beranda.teams'); //perbaiki

// partners
Route::get('/mitra', [GeneralController::class, 'mitra'])->name('beranda.mitra');

// programs
Route::get('/program/show-all', [ProgramController::class, 'show'])->name('beranda.program');
Route::get('/program/kategori/{slug}', [ProgramController::class, 'showSlug'])->name('program.kategori');

// publikasi
Route::get('/publikasi/show-all/', [PublikasiController::class, 'show'])->name('beranda.publikasi');
Route::get('/show-pdf/{filePath}', [PublikasiController::class, 'showPdf'])->where('filePath', '.*')->name('publikasi.pdf');

// middleware authtentication
Route::middleware(['auth.admin'])->group(function () {
    // general-setting
    Route::get('/admin/general-setting', [ProfileController::class, 'index'])->name('admin.profiles');
    Route::put('/admin/general-setting/update/{id}', [ProfileController::class, 'update'])->name('profiles.update');


    // sosial-media
    Route::get('/admin/sosial-media', [SosiaMediaController::class, 'index'])->name('admin.sosmed');
    Route::get('/admin/datatable/sosial-media', [SosiaMediaController::class, 'getDataTables'])->name('sosmed.table');

    Route::get('/admin/sosial-media/store', [SosiaMediaController::class, 'showFormStore'])->name('sosmed.formStore');
    Route::post('/admin/sosial-media', [SosiaMediaController::class, 'store'])->name('sosmed.store');

    Route::get('/admin/sosial-media/edit/{id}', [SosiaMediaController::class, 'showFormEdit'])->name('sosmed.formEdit');
    Route::put('/admin/sosial-media/{id}', [SosiaMediaController::class, 'update'])->name('sosmed.update');

    Route::delete('/admin/sosial-media/destroy/{id}', [SosiaMediaController::class, 'destroy'])->name('sosmed.delete');


    // kategori-program
    Route::get('/admin/kategori-program', [KategoriProgramController::class, 'index'])->name('admin.kategoriProgram');
    Route::get('/admin/datatable/kategori-program', [KategoriProgramController::class, 'getDataTables'])->name('kategoriProgram.table');

    Route::get('/admin/kategori-program/store', [KategoriProgramController::class, 'showFormStore'])->name('kategoriProgram.formStore');
    Route::post('/admin/kategori-program', [KategoriProgramController::class, 'store'])->name('kategoriProgram.store');

    Route::get('/admin/kategori-program/edit/{id}', [KategoriProgramController::class, 'showFormEdit'])->name('kategoriProgram.formUpdate');
    Route::put('/admin/kategori-program/{id}', [KategoriProgramController::class, 'update'])->name('kategoriProgram.update');

    Route::delete('/admin/kategori-program/destroy/{id}', [KategoriProgramController::class, 'destroy'])->name('kategoriProgram.delete');


    // program
    Route::get('/admin/program', [ProgramController::class, 'index'])->name('admin.program');
    Route::get('/admin/datatable/program', [ProgramController::class, 'getDataTables'])->name('program.table');

    Route::get('/admin/program/store', [ProgramController::class, 'showFormStore'])->name('program.formStore');
    Route::post('/admin/program', [ProgramController::class, 'store'])->name('program.store');

    Route::get('/admin/program/edit/{id}', [ProgramController::class, 'showFormEdit'])->name('program.formUpdate');
    Route::put('/admin/program/{id}', [ProgramController::class, 'update'])->name('program.update');

    Route::delete('/admin/program/destroy/{id}', [ProgramController::class, 'destroy'])->name('program.delete');


    // gallery
    Route::get('/admin/gallery-photo', [GalleryController::class, 'indexPhoto'])->name('admin.galleryPhoto');
    Route::get('/admin/gallery-video', [GalleryController::class, 'indexVideo'])->name('admin.galleryVideo');
    Route::get('/admin/datatable/gallery-photo', [GalleryController::class, 'getDataTablesPhoto'])->name('galleryPhoto.table');
    Route::get('/admin/datatable/gallery-video', [GalleryController::class, 'getDataTablesVideo'])->name('galleryVideo.table');

    Route::get('/admin/gallery/store/{kategori}', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
    Route::post('/admin/gallery', [GalleryController::class, 'store'])->name('gallery.store');

    Route::get('/admin/gallery/edit/{id}', [GalleryController::class, 'showFormEdit'])->name('gallery.formEdit');
    Route::put('/admin/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');

    Route::delete('/admin/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');


    // Kategori-news-event
    Route::get('/admin/kategori-news-event', [kategoriNewsEventController::class, 'index'])->name('admin.kategoriBerita');
    Route::get('/admin/datatable/kategori-news-event', [kategoriNewsEventController::class, 'getDataTables'])->name('kategoriBerita.table');

    Route::get('/admin/kategori-news-event/store', [kategoriNewsEventController::class, 'showFormStore'])->name('kategoriBerita.formStore');
    Route::post('/admin/kategori-news-event', [kategoriNewsEventController::class, 'store'])->name('kategoriBerita.store');

    Route::get('/admin/kategori-news-event/edit/{id}', [kategoriNewsEventController::class, 'showFormEdit'])->name('kategoriBerita.formEdit');
    Route::put('/admin/kategori-news-event/{id}', [kategoriNewsEventController::class, 'update'])->name('kategoriBerita.update');

    Route::delete('/admin/kategori-news-event/destroy/{id}', [kategoriNewsEventController::class, 'destroy'])->name('kategoriBerita.delete');


    // news-dan-event 
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::get('/admin/datatable/berita', [BeritaController::class, 'getDataTables'])->name('berita.table');

    Route::get('/admin/berita/store', [BeritaController::class, 'showFormStore'])->name('berita.formStore');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('berita.store');

    Route::get('/admin/berita/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');

    Route::delete('/admin/berita/destroy/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');


    // menus
    Route::get('/admin/menus', [MenusController::class, 'index'])->name('admin.menus');
    Route::get('/admin/datatable/menus', [MenusController::class, 'getDataTables'])->name('menus.table');

    Route::get('/admin/menus/store', [MenusController::class, 'showFormStore'])->name('menus.formStore');
    Route::post('/admin/menus', [MenusController::class, 'store'])->name('menus.store');

    Route::get('/admin/menus/edit/{id}', [MenusController::class, 'showFormEdit'])->name('menus.formEdit');
    Route::put('/admin/menus/{id}', [MenusController::class, 'update'])->name('menus.update');

    Route::delete('/admin/menus/destroy/{id}', [MenusController::class, 'destroy'])->name('menus.delete');


    //jenis-publikasi 
    Route::get('/admin/jenis-publikasi', [JenisPublikasiController::class, 'index'])->name('admin.jenisPublikasi');
    Route::get('/admin/datatable/jenis-publikasi', [JenisPublikasiController::class, 'getDataTables'])->name('jenisPublikasi.table');

    Route::get('/admin/jenis-publikasi/store', [JenisPublikasiController::class, 'showFormStore'])->name('jenisPublikasi.formStore');
    Route::post('/admin/jenis-publikasi', [JenisPublikasiController::class, 'store'])->name('jenisPublikasi.store');

    Route::get('/admin/jenis-publikasi/edit/{id}', [JenisPublikasiController::class, 'showFormEdit'])->name('jenisPublikasi.formEdit');
    Route::put('/admin/jenis-publikasi/{id}', [JenisPublikasiController::class, 'update'])->name('jenisPublikasi.update');

    Route::delete('/admin/jenis-publikasi/destroy/{id}', [JenisPublikasiController::class, 'destroy'])->name('jenisPublikasi.delete');


    //publikasi 
    Route::get('/admin/publikasi', [PublikasiController::class, 'index'])->name('admin.publikasi');
    Route::get('/admin/datatable/publikasi', [PublikasiController::class, 'getDataTables'])->name('publikasi.table');

    Route::get('/admin/publikasi/store', [PublikasiController::class, 'showFormStore'])->name('publikasi.formStore');
    Route::post('/admin/publikasi', [PublikasiController::class, 'store'])->name('publikasi.store');

    Route::get('/admin/publikasi/edit/{id}', [PublikasiController::class, 'showFormEdit'])->name('publikasi.formEdit');
    Route::put('/admin/publikasi/{id{', [PublikasiController::class, 'update'])->name('publikasi.update');

    Route::delete('/admin/publikasi/destroy/{id}', [PublikasiController::class, 'destroy'])->name('publikasi.delete');


    // logout
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth routes
// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// personal-data-user
Route::get('/register/{id}', [AuthController::class, 'showFormUser'])->name('register.dataUser');
Route::post('/add-data-user', [AuthController::class, 'addDataUser'])->name('add.dataUser');


// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
