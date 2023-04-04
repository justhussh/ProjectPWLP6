<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswasController;
use Illuminate\Http\Request;

Route::resource('mahasiswas', MahasiswasController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [MahasiswasController::class, 'search'])->name('search');