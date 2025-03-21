<?php

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

Route::get('/', function () {
    return view('index');
});
Route::get('/kategori', function () {
    return view('kategori');
});
Route::get('/bookmark', function () {
    return view('bookmark');
});

Route::get('/login', function () {
    return view('livewire.login-comp');
});
Route::get('/manajemen-user', UsersAdminComp::class)->name('manajemen-user');
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login')->with('success', 'Logout berhasil!');
})->name('logout');
