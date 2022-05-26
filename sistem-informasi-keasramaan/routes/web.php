<?php

use App\Http\Controllers\Koordinator\AsramaController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Koordinator\KoordinatorController;
use App\Http\Controllers\Petugas\PetugasController;
use Illuminate\Support\Facades\Route;

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

//Route:Mahasiswa
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function(){
    Route::middleware(['guest:web', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/login', 'auth.mahasiswa.login')->name('login');
        Route::view('/register', 'auth.mahasiswa.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');

    });

    Route::middleware(['auth:web', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/home', 'mahasiswa.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

//Route:Petugas
Route::prefix('petugas')->name('petugas.')->group(function(){
    Route::middleware(['guest:petugas', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/login', 'auth.petugas.login')->name('login');
        Route::post('/check', [PetugasController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:petugas', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/home', 'petugas.home')->name('home');
        Route::post('/logout', [PetugasController::class, 'logout'])->name('logout');
    });
});

//Route:Koordinator
Route::prefix('koordinator')->name('koordinator.')->group(function() {

    Route::middleware(['guest:koordinator', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/login', 'auth.koordinator.login')->name('login');
        Route::post('/check', [KoordinatorController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:koordinator', 'PreventBackButtonHistory'])->group(function () {
        Route::view('/home', 'koordinator.home')->name('home');

        Route::get('/data-asrama', [AsramaController::class, 'showDataAsrama'])->name('show.asrama');
        Route::view('/tambah-data-asrama', 'koordinator.asrama.create')->name('create.asrama');
        Route::post('/simpan-data-asrama', [AsramaController::class, 'storeDataAsrama'])->name('store.asrama');

        Route::post('/logout', [KoordinatorController::class, 'logout'])->name('logout');
    });
});