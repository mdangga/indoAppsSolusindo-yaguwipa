<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/berita', function () {
    return view('berita');
});
Route::get('/signin', function () {
    return view('signin');
});
