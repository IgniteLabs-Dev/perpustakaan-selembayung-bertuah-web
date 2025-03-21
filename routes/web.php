<?php

use App\Http\Controllers\LoginController;
use App\Livewire\LoginComp;
use App\Livewire\UsersAdminComp;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login', [LoginController::class, 'loginPage'])->name('login');
Route::get('register', [LoginController::class, 'registerPage'])->name('register');
Route::post('/registerProses', [LoginController::class, 'registerProses'])->name('register.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginStore', [LoginController::class, 'loginStore'])->name('login.proses');


Route::get('/', function () {
    return view('index');
});
Route::get('/kategori', function () {
    return view('kategori');
});
Route::get('/bookmark', function () {
    return view('bookmark');
});



Route::get('/manajemen-user', UsersAdminComp::class)->name('admin-manajemen-user');
