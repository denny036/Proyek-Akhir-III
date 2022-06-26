<?php

use App\Http\Controllers\Koordinator\AsramaController;
use App\Http\Controllers\Koordinator\DataPetugasController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Koordinator\KoordinatorController;
use App\Http\Controllers\Petugas\CheckInPetugasController;
use App\Http\Controllers\Petugas\IBController;
use App\Http\Controllers\Petugas\ISController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\User\CheckInController;
use App\Http\Controllers\User\IzinBermalamController;
use App\Http\Controllers\User\IzinSakitController;
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
        Route::get('/request-check-in', [CheckInController::class, 'showFormCheckIn'])->name('request.check-in');
        Route::post('/simpan-check-in', [CheckInController::class, 'storeCheckIn'])->name('store.check-in');
        Route::get('/check-in/detail/{id}', [CheckInController::class, 'getDetailCheckIn'])->name('detail.check-in');

        // Route::get('/check-out', [CheckOutController:class, 'showDataCheckOut'])->name('show.check-out');
        // Route::view('/request-check-out', 'mahasiswa.check-out.create')->name('create.check-out');
        // Route::post('/simpan-check-out', [CheckOutController::class, 'storeCheckOut'])->name('store.check-out');

        Route::get('/izin-bermalam', [IzinBermalamController::class, 'showPageIzinBermalam'])->name('izin-bermalam');
        Route::get('/request-izin-bermalam', [IzinBermalamController::class, 'showReqIB'])->name('request.izin-bermalam');
        Route::post('/simpan-izin-bermalam', [IzinBermalamController::class, 'storeIB'])->name('store.izin-bermalam');
        Route::get('/izin-bermalam/detail/{izin_bermalam_id}', [IzinBermalamController::class, 'getDetailIB'])->name('detail.izin-bermalam');
        Route::get('/izin-bermalam/print/{izin_bermalam_id}', [IzinBermalamController::class, 'printSuratIB'])->name('print.surat-ib');
        
        Route::get('izin-sakit', [IzinSakitController::class, 'showPageIzinSakit'])->name('izin-sakit');
        Route::get('request-izin-sakit', [IzinSakitController::class, 'showReqIS'])->name('request.izin-sakit');
        Route::post('/simpan-izin-sakit', [IzinSakitController::class, 'storeIS'])->name('store.izin-sakit');
        Route::get('izin-sakit/detail/{izin_sakit_id}', [IzinSakitController::class, 'getDetailIzinSakit'])->name('detail.izin-sakit');

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
        
        Route::get('/home', [PetugasController::class, 'showHomePetugas'])->name('home');

        Route::get('/check-in-mahasiswa', [CheckInPetugasController::class, 'showPageCheckIn'])->name('check-in');
        Route::get('/check-in-mahasiswa/detail/{check_in_id}', [CheckInPetugasController::class, 'getDetailCheckIn'])->name('detail-check-in');
        Route::get('/check-in-mahasiswa/detail/terima/{id}', [CheckInPetugasController::class, 'acceptCheckIn'])->name('accept.check-in');
        Route::get('/check-in-mahasiswa/detail/tolak/{id}', [CheckInPetugasController::class, 'rejectCheckIn'])->name('reject.check-in');

        Route::get('/izin-bermalam-mahasiswa', [IBController::class, 'showPageIBMhs'])->name('izin-bermalam');
        Route::get('/izin-bermalam-mahasiswa/detail/{izin_bermalam_id}', [IBController::class, 'getDetailIB'])->name('detail-izin-bermalam');
        Route::get('/izin-bermalam-mahasiswa/detail/terima/{id}', [IBController::class, 'accIB'])->name('accept.izin-bermalam');
        Route::get('/izin-bermalam-mahasiswa/detail/tolak/{id}', [IBController::class, 'rejectIB'])->name('reject.izin-bermalam');

        Route::get('/izin-sakit-mahasiswa', [ISController::class, 'showPageISMhs'])->name('izin-sakit');
        Route::get('/izin-sakit-mahasiswa/detail/{izin_sakit_id}', [ISController::class, 'getDetailIS'])->name('detail-izin-sakit');
        Route::get('/izin-sakit-mahasiswa/detail/terima/{id}', [ISController::class, 'accIzinSakit'])->name('accept.izin-sakit');
        Route::get('/izin-sakit-mahasiswa/detail/tolak/{id}', [ISController::class, 'rejectIzinSakit'])->name('reject.izin-sakit');
        Route::patch('/izin-sakit-mahasiswa/detail/update-kondisi/{id}', [ISController::class, 'updateKondisiMahasiswa'])->name('update.kondisi-mahasiswa');

        Route::get('/data-petugas', [PetugasController::class, 'getAllPetugas'])->name('data-petugas');
        Route::get('/data-penghuni-asrama', [PetugasController::class, 'getPenghuniAsrama'])->name('data-penghuni-asrama');
        Route::get('/data-penghuni-asrama/{asrama_id}', [PetugasController::class, 'showDetailAsrama'])->name('detail.penghuni-asrama');
        
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

        Route::get('/home', [KoordinatorController::class, 'showDashboardKoordinator'])->name('home');
        Route::get('/detail-keasramaan/{asrama_id}', [KoordinatorController::class, 'showDetailDashboard'])->name('detail.keasramaan');

        Route::get('/data-asrama', [AsramaController::class, 'showDataAsrama'])->name('show.asrama');
        Route::view('/tambah-data-asrama', 'koordinator.asrama.create')->name('create.asrama');
        Route::post('/simpan-data-asrama', [AsramaController::class, 'storeDataAsrama'])->name('store.asrama');

        Route::get('/data-petugas', [DataPetugasController::class, 'showDataPetugas'])->name('show.data-petugas');
        Route::get('/tambah-petugas', [DataPetugasController::class, 'showFormTambahPetugas'])->name('form-tambah-petugas');
        Route::post('/simpan-petugas', [DataPetugasController::class, 'storeDataPetugas'])->name('store.data-petugas');

        Route::get('/data-petugas/{petugas_id}', [DataPetugasController::class, 'showFormEditPetugas'])->name('form-edit-petugas');
        Route::put('/update-petugas/{petugas_id}', [DataPetugasController::class, 'updateDataPetugas'])->name('update.data-petugas');

        Route::post('/logout', [KoordinatorController::class, 'logout'])->name('logout');
    });
});