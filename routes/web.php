<?php


use App\Http\Controllers\MahasiswasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::resource('mahasiswas', MahasiswasController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [MahasiswasController::class, 'search'])->name('search');
Route::get('/khs/{Nim}', [MahasiswasController::class, 'khs'])->name('khs');
Route::get('/khs/{mahasiswa_id}/print_pdf', [MahasiswasController::class, 'print_pdf'])->name('print_pdf');