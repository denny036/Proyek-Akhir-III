<?php

use App\Http\Controllers\User\UserController;
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

// Route::get('register', function() {
//     return view ('auth.register');
// });


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