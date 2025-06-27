<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita/create', function () {
    return view('testing');
});
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/slug/{slug}', [BeritaController::class, 'showBySlug']);
Route::post('/berita', [BeritaController::class, 'store']);
Route::put('/berita/{id}', [BeritaController::class, 'update']);
Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
