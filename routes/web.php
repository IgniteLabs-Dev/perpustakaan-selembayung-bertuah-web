<?php

use App\Http\Controllers\LoginController;
use App\Livewire\AdminAuthorComp;
use App\Livewire\AdminBookComp;
use App\Livewire\AdminCategoryComp;
use App\Livewire\AdminLoanTransactionComp;
use App\Livewire\AdminRewardComp;
use App\Livewire\AdminUsersComp;
use App\Livewire\BookDetailComp;
use App\Livewire\BookExplorerComp;
use App\Livewire\BookmarkComp;
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
    return view('pages.index');
})->name('index');


Route::get('/buku/{search?}', BookExplorerComp::class)->name('jelajahi-buku');
Route::get('/bookmark', BookmarkComp::class)->name('bookmark');
Route::get('/buku/detail/{id}', BookDetailComp::class)->name('detail-buku');

Route::get('/manajemen-user', AdminUsersComp::class)->name('admin-manajemen-user');
Route::get('/manajemen-reward', AdminRewardComp::class)->name('admin-manajemen-reward');
Route::get('/manajemen-buku', AdminBookComp::class)->name('admin-manajemen-buku');
Route::get('/manajemen-kategori', AdminCategoryComp::class)->name('admin-manajemen-kategori');
Route::get('/manajemen-penulis', AdminAuthorComp::class)->name('admin-manajemen-penulis');
Route::get('/manajemen-peminjaman', AdminLoanTransactionComp::class)->name('admin-manajemen-peminjaman');
