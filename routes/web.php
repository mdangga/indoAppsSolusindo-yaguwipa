<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// testing area
Route::get('/', [BeritaController::class, 'beranda'])->name('beranda');
Route::get('/testing1', function () {
    return view('profiles');
});
Route::get('/testing2', function () {
    return view('partners');
});
Route::get('/testing3', function () {
    return view('teams');
});

// gallery
Route::get('/gallery', function () {
    return view('gallery');
});


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
