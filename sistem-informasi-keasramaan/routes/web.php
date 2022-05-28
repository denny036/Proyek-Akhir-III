<?php

use App\Http\Controllers\Koordinator\AsramaController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Koordinator\KoordinatorController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\User\CheckInController;
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
})->name('welcome');

//Route:Mahasiswa
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function(){
    Route::middleware(['guest:web', 'PreventBackButtonHistory'])->group(function(){
        Route::view('/login', 'auth.mahasiswa.login')->name('login');
        Route::view('/register', 'auth.mahasiswa.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');

    });

    Route::middleware(['auth:web', 'PreventBackButtonHistory'])->group(function(){
        Route::get('/home', [UserController::class, 'showHomeMahasiswa'])->name('home');

        Route::get('/profile', [UserController::class, 'getDataAsrama'])->name('profile');
        Route::post('/simpan-asrama-mahasiswa', [UserController::class, 'storeAsramaMahasiswa'])->name('store.profile');

        Route::get('/check-in', [CheckInController::class, 'showDataCheckIn'])->name('show.check-in');
        Route::get('/request-check-in', [CheckInController::class, 'showFormCheckIn'])->name('create.check-in');
        Route::post('/simpan-check-in', [CheckInController::class, 'storeCheckIn'])->name('store.check-in');

        // Route::get('/check-out', [CheckOutController:class, 'showDataCheckOut'])->name('show.check-out');
        // Route::view('/request-check-out', 'mahasiswa.check-out.create')->name('create.check-out');
        // Route::post('/simpan-check-out', [CheckOutController::class, 'storeCheckOut'])->name('store.check-out');
        
        // Route::get('/izin-sakit', [IzinSakitController::class, 'showDataIzinSakit'])->name('show.izin-sakit');
        // Route::view('/request-izin-sakit', 'mahasiswa.izin-sakit.create')->name('create.izin-sakit');
        // Route::post('/simpan-izin-sakit', [IzinSakitController::class,'storeIzinSakit')->name('store.izin-sakit');

        // Route::get('/izin-bermalam', [IzinBermalamController::class, 'showDataIzinBermalam'])->name('show.izin-bermalam');
        // Route::view('/request-izin-bermalam', 'mahasiswa.izin-bermalam.create')->name('create.izin-bermaalam');
        // Route::post('/simpan-izin-bermalam', [IzinBermalamController::class, 'storeIzinBermalam')->name('store.izin-bermalam');
        
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