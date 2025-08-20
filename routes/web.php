<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InstitusiController;
use App\Http\Controllers\JenisPublikasiController;
use App\Http\Controllers\KataKotorController;
use App\Http\Controllers\kategoriNewsEventController;
use App\Http\Controllers\KategoriProgramController;
use App\Http\Controllers\KerjaSamaController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SosiaMediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// testing-area
Route::get('/donasi/success', [DonasiController::class, 'success'])->name('donasi.success');
Route::get('/donasi/failure', [DonasiController::class, 'failure'])->name('donasi.failure');


Route::get('/testing/{id}', [PdfController::class, 'testing'])->name('testing');

// route-default beranda
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
Route::get('/program/{id}', [ProgramController::class, 'showProgam'])->name('beranda.showProgram');

// campaign
Route::get('/program/campaign/{slug}', [CampaignController::class, 'showSlug'])->name('campaign.slug');

// publikasi
Route::get('/publikasi/show-all', [PublikasiController::class, 'show'])->name('beranda.publikasi');
Route::get('/show-pdf/{filePath}', [PublikasiController::class, 'showPdf'])->where('filePath', '.*')->name('publikasi.pdf');
Route::post('/download-file/{id}', [PublikasiController::class, 'downloadFile'])->name('file.Download');

// notifikasi
Route::get('/notifications/read/{id}', [NotificationController::class, 'bacaSatuNotif'])->name('notifications.read');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/read-all', [NotificationController::class, 'bacaSemuaNotif'])->name('notifications.readAll');

// donasi
Route::get('/donasi/create/{id_campaign}', [DonasiController::class, 'show'])->name('form.donasi');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

// admin
Route::middleware(['auth', 'auth.role:admin'])->prefix('admin')->group(function () {
    // general-setting
    Route::prefix('general-setting')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profiles');
        Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profiles.update');
    });


    // campaigns
    Route::prefix('campaigns')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('admin.campaigns');
        Route::get('/datatable', [CampaignController::class, 'getDataTables'])->name('campaigns.table');
        Route::get('/create', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::get('/edit/{id}', [CampaignController::class, 'showFormEdit'])->name('campaigns.edit');
        Route::put('/{id}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::delete('/destroy/{id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
    });

    // user
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('/datatable', [UserController::class, 'getDataTables'])->name('user.table');
        Route::delete('/deactivate/{id}', [UserController::class, 'deactivateUser'])->name('user.deactivate');
        Route::post('/restore/{id}', [UserController::class, 'restoreUser'])->name('user.restore');
    });

    // sosial-media
    Route::prefix('sosial-media')->group(function () {
        Route::get('/', [SosiaMediaController::class, 'index'])->name('admin.sosmed');
        Route::get('/datatable', [SosiaMediaController::class, 'getDataTables'])->name('sosmed.table');
        Route::get('/create', [SosiaMediaController::class, 'showFormStore'])->name('sosmed.formStore');
        Route::post('/', [SosiaMediaController::class, 'store'])->name('sosmed.store');
        Route::get('/edit/{id}', [SosiaMediaController::class, 'showFormEdit'])->name('sosmed.formEdit');
        Route::put('/{id}', [SosiaMediaController::class, 'update'])->name('sosmed.update');
        Route::delete('/destroy/{id}', [SosiaMediaController::class, 'destroy'])->name('sosmed.delete');
    });

    // institusi-terlibat
    Route::prefix('institusi-terlibat')->group(function () {
        Route::get('/', [InstitusiController::class, 'index'])->name('admin.institusi');
        Route::get('/datatable', [InstitusiController::class, 'getDataTables'])->name('institusi.table');
        Route::get('/create', [InstitusiController::class, 'showFormStore'])->name('institusi.formStore');
        Route::post('/', [InstitusiController::class, 'store'])->name('institusi.store');
        Route::get('/edit/{id}', [InstitusiController::class, 'showFormEdit'])->name('institusi.formEdit');
        Route::put('/{id}', [InstitusiController::class, 'update'])->name('institusi.update');
        Route::delete('/destroy/{id}', [InstitusiController::class, 'destroy'])->name('institusi.delete');
    });

    // kategori-program
    Route::prefix('kategori-program')->group(function () {
        Route::get('/', [KategoriProgramController::class, 'index'])->name('admin.kategoriProgram');
        Route::get('/datatable', [KategoriProgramController::class, 'getDataTables'])->name('kategoriProgram.table');
        Route::get('/create', [KategoriProgramController::class, 'showFormStore'])->name('kategoriProgram.formStore');
        Route::post('/', [KategoriProgramController::class, 'store'])->name('kategoriProgram.store');
        Route::get('/edit/{id}', [KategoriProgramController::class, 'showFormEdit'])->name('kategoriProgram.formUpdate');
        Route::put('/{id}', [KategoriProgramController::class, 'update'])->name('kategoriProgram.update');
        Route::delete('/destroy/{id}', [KategoriProgramController::class, 'destroy'])->name('kategoriProgram.delete');
    });

    // program
    Route::prefix('program')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('admin.program');
        Route::get('/datatable', [ProgramController::class, 'getDataTables'])->name('program.table');
        Route::get('/create', [ProgramController::class, 'showFormStore'])->name('program.formStore');
        Route::post('/', [ProgramController::class, 'store'])->name('program.store');
        Route::get('/edit/{id}', [ProgramController::class, 'showFormEdit'])->name('program.formUpdate');
        Route::put('/{id}', [ProgramController::class, 'update'])->name('program.update');
        Route::delete('/destroy/{id}', [ProgramController::class, 'destroy'])->name('program.delete');
    });


    // gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/photo', [GalleryController::class, 'indexPhoto'])->name('admin.galleryPhoto');
        Route::get('/video', [GalleryController::class, 'indexVideo'])->name('admin.galleryVideo');
        Route::get('/datatable/photo', [GalleryController::class, 'getDataTablesPhoto'])->name('galleryPhoto.table');
        Route::get('/datatable/video', [GalleryController::class, 'getDataTablesVideo'])->name('galleryVideo.table');
        Route::get('/create/{kategori}', [GalleryController::class, 'showFormStore'])->name('gallery.formStore');
        Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/edit/{id}', [GalleryController::class, 'showFormEdit'])->name('gallery.formEdit');
        Route::put('/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    });


    // Kategori-news-event
    Route::prefix('kategori-news-event')->group(function () {
        Route::get('/', [kategoriNewsEventController::class, 'index'])->name('admin.kategoriBerita');
        Route::get('/datatable', [kategoriNewsEventController::class, 'getDataTables'])->name('kategoriBerita.table');
        Route::get('/create', [kategoriNewsEventController::class, 'showFormStore'])->name('kategoriBerita.formStore');
        Route::post('/', [kategoriNewsEventController::class, 'store'])->name('kategoriBerita.store');
        Route::get('/edit/{id}', [kategoriNewsEventController::class, 'showFormEdit'])->name('kategoriBerita.formEdit');
        Route::put('/{id}', [kategoriNewsEventController::class, 'update'])->name('kategoriBerita.update');
        Route::delete('/destroy/{id}', [kategoriNewsEventController::class, 'destroy'])->name('kategoriBerita.delete');
    });


    // news-dan-event 
    Route::prefix('news-event')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('admin.berita');
        Route::get('/datatable', [BeritaController::class, 'getDataTables'])->name('berita.table');
        Route::get('/create', [BeritaController::class, 'showFormStore'])->name('berita.formStore');
        Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/destroy/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');
    });


    // menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenusController::class, 'index'])->name('admin.menus');
        Route::get('/datatable', [MenusController::class, 'getDataTables'])->name('menus.table');

        Route::get('/create', [MenusController::class, 'showFormStore'])->name('menus.formStore');
        Route::post('/', [MenusController::class, 'store'])->name('menus.store');

        Route::get('/edit/{id}', [MenusController::class, 'showFormEdit'])->name('menus.formEdit');
        Route::put('/{id}', [MenusController::class, 'update'])->name('menus.update');

        Route::delete('/destroy/{id}', [MenusController::class, 'destroy'])->name('menus.delete');
    });


    // jenis-publikasi 
    Route::prefix('jenis-publikasi')->group(function () {
        Route::get('/', [JenisPublikasiController::class, 'index'])->name('admin.jenisPublikasi');
        Route::get('/datatable', [JenisPublikasiController::class, 'getDataTables'])->name('jenisPublikasi.table');

        Route::get('/create', [JenisPublikasiController::class, 'showFormStore'])->name('jenisPublikasi.formStore');
        Route::post('/', [JenisPublikasiController::class, 'store'])->name('jenisPublikasi.store');

        Route::get('/edit/{id}', [JenisPublikasiController::class, 'showFormEdit'])->name('jenisPublikasi.formEdit');
        Route::put('/{id}', [JenisPublikasiController::class, 'update'])->name('jenisPublikasi.update');

        Route::delete('/destroy/{id}', [JenisPublikasiController::class, 'destroy'])->name('jenisPublikasi.delete');
    });


    // publikasi 
    Route::prefix('publikasi')->group(function () {
        Route::get('/', [PublikasiController::class, 'index'])->name('admin.publikasi');
        Route::get('/datatable', [PublikasiController::class, 'getDataTables'])->name('publikasi.table');

        Route::get('/create', [PublikasiController::class, 'showFormStore'])->name('publikasi.formStore');
        Route::post('/', [PublikasiController::class, 'store'])->name('publikasi.store');

        Route::get('/edit/{id}', [PublikasiController::class, 'showFormEdit'])->name('publikasi.formEdit');
        Route::put('/{id{', [PublikasiController::class, 'update'])->name('publikasi.update');

        Route::delete('/destroy/{id}', [PublikasiController::class, 'destroy'])->name('publikasi.delete');
    });


    // kerja-sama
    Route::prefix('kerja-sama')->group(function () {
        Route::get('/', [KerjaSamaController::class, 'index'])->name('admin.kerjaSama');
        Route::get('/datatable', [KerjaSamaController::class, 'getDataTables'])->name('kerjaSama.table');
        Route::get('/detail-kerja-sama/{id}', [KerjaSamaController::class, 'detailKerjaSama'])->name('kerjaSama.detail');
        Route::post('/approved/{id}', [KerjaSamaController::class, 'approved'])->name('kerjaSama.approved');
        Route::post('/rejected/{id}', [KerjaSamaController::class, 'rejected'])->name('kerjaSama.rejected');
        Route::delete('/destroy/{id}', [KerjaSamaController::class, 'destroy'])->name('kerjaSama.delete');
    });


    // review
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('admin.review');
        Route::post('/', [ReviewController::class, 'manajemenKataKotor']);
        Route::post('/approved/{id}', [ReviewController::class, 'approve'])->name('review.approve');
    });


    // kata-kotor
    Route::prefix('kata-kotor')->group(function () {
        Route::get('/', [KataKotorController::class, 'index'])->name('admin.kataKotor');
        Route::post('/', [KataKotorController::class, 'store'])->name('kataKotor.store');
        Route::put('/{id}', [KataKotorController::class, 'update'])->name('kataKotor.update');
        Route::delete('/destroy/{id}', [KataKotorController::class, 'destroy'])->name('kataKotor.destroy');
    });


    // donasi
    Route::prefix('donasi')->group(function () {
        Route::get('/', [DonasiController::class, 'index'])->name('admin.donasi');
        Route::get('/datatable', [DonasiController::class, 'getDataTables'])->name('donasi.table');
        Route::get('/detail-donasi/{id}', [DonasiController::class, 'detailDonasi'])->name('donasi.detail');

        // barang
        Route::post('/barang/approved/{id}', [DonasiController::class, 'approveBarang'])->name('barang.approved');
        Route::post('/barang/rejected/{id}', [DonasiController::class, 'rejectBarang'])->name('barang.rejected');

        // jasa
        Route::post('/jasa/approved/{id}', [DonasiController::class, 'approveJasa'])->name('jasa.approved');
        Route::post('/jasa/rejected/{id}', [DonasiController::class, 'rejectJasa'])->name('jasa.rejected');

        // donasi
        Route::post('/donasi/approved/{id}', [DonasiController::class, 'approveDonasi'])->name('donasi.approved');
        Route::post('/donasi/rejected/{id}', [DonasiController::class, 'rejectDonasi'])->name('donasi.rejected');
    });
});


// mitra-dan-donatur 
Route::middleware(['auth', 'auth.role:mitra,donatur'])->prefix('user')->group(function () {
    // register mitra
    Route::prefix('mitra/register')->group(function () {
        Route::get('/create', [UserController::class, 'showJoinMitra'])->name('mitra.join');
        Route::post('/{id}', [UserController::class, 'addDataMitra'])->name('add.dataMitra');
    });

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');


    // review
    Route::prefix('review')->group(function () {
        Route::post('/create', [ReviewController::class, 'store'])->name('review.store');
        Route::put('/edit/{id}', [ReviewController::class, 'update'])->name('review.update');
    });


    // edit profile
    Route::prefix('edit-profile')->group(function () {
        Route::get('/', [UserController::class, 'showEditProfile'])->name('user.edit-profile');
        Route::put('/photo', [UserController::class, 'updatePhoto'])->name('edit-profile.photo');
        Route::put('/info', [UserController::class, 'updateInfo'])->name('edit-profile.info');
        Route::put('/password', [UserController::class, 'updatePassword'])->name('edit-profile.password');
        Route::put('/settings', [UserController::class, 'updateSettings'])->name('edit-profile.settings');
        Route::delete('/deactivate-account', [UserController::class, 'deactivate'])->name('profile.deactivate');
        Route::delete('/delete-account', [UserController::class, 'forceDelete'])->name('profile.delete');
    });

    // detail-donasi
    Route::get('/detail-donasi/{id}', [DonasiController::class, 'showDetailDonasi'])->name('user-donasi.detail');

    // daftar-donasi
    Route::get('/daftarDonasi', [CampaignController::class, 'showUserCampaign'])->name('daftar.donasi');

    // activity
    Route::get('/activity', [UserController::class, 'showActivityAll'])->name('user.activity');
});


Route::middleware(['auth', 'auth.role:mitra'])->prefix('mitra')->group(function () {
    // kerja-sama
    Route::prefix('kerja-sama')->group(function () {
        Route::get('/', [KerjaSamaController::class, 'showformStore'])->name('kerja-sama.formStore');
        Route::post('/create', [KerjaSamaController::class, 'store'])->name('kerja-sama.store');
        Route::get('/edit/{id}', [KerjaSamaController::class, 'showFormEdit'])->name('kerja-sama.formEdit');
        Route::put('/{id}', [KerjaSamaController::class, 'update'])->name('kerja-sama.update');
        Route::delete('/destroy/{id}', [KerjaSamaController::class, 'batalkanKerjaSama'])->name('kerja-sama.destroy');

        Route::get('/detail-kerja-sama/{id}', [KerjaSamaController::class, 'showDetailKerjaSama'])->name('kerja-sama.detail');
    });
});

Route::middleware(['auth', 'auth.role:mitra,admin'])->group(function () {
    // kerja-sama
    Route::prefix('kerja-sama')->group(function () {
        Route::get('/kerja-sama/file/{id}', [fileController::class, 'showFileKerjaSama'])->name('kerja-sama.file.show');
        // Route::get('/kerja-sama/file/{id}/download', [FileKerjaSamaController::class, 'download'])->name('kerja-sama.file.download');
        Route::get('/zip/download-file/{id}/{nama}', [PdfController::class, 'downloadZipStream'])->name('download.zip');
    });
});


Route::prefix('review')->group(function () {
    Route::delete('/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
});


// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// pulihkan-akun
Route::get('/restore-account', function () {
    return view('restore');
})->name('restore');
Route::post('/profile/restore', [UserController::class, 'restore'])->name('profile.restore');


// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
