<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/gallery', [GalleryController::class, 'index']);