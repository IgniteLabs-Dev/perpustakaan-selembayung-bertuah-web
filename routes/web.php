<?php

use App\Http\Controllers\LoginController;
use App\Livewire\AdminAuthorComp;
use App\Livewire\AdminBookComp;
use App\Livewire\AdminCategoryComp;
use App\Livewire\AdminLoanReturnComp;
use App\Livewire\AdminLoanTransactionComp;
use App\Livewire\AdminRewardComp;
use App\Livewire\AdminUsersComp;
use App\Livewire\AdminVisitorComp;
use App\Livewire\BookDetailComp;
use App\Livewire\BookExplorerComp;
use App\Livewire\BookmarkComp;
use App\Livewire\Dashboard;
use App\Livewire\HistoryLoanComp;
use App\Livewire\LoginComp;
use App\Livewire\ProfileComp;
use App\Livewire\UsersAdminComp;
use App\Livewire\VisitorComp;
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


Route::get('/profile', ProfileComp::class)->name('profile');
Route::get('/buku/{search?}', BookExplorerComp::class)->name('jelajahi-buku');
Route::get('/favorit', BookmarkComp::class)->name('favorit');
Route::get('/riwayat-peminjaman', HistoryLoanComp::class)->name('riwayat-peminjaman');
Route::get('/buku/detail/{id}', BookDetailComp::class)->name('detail-buku');

Route::middleware(['auth-jwt'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/manajemen-user', AdminUsersComp::class)->name('admin-manajemen-user');
    // Route::get('/manajemen-point', AdminRewardComp::class)->name('admin-manajemen-point');
    Route::get('/manajemen-buku', AdminBookComp::class)->name('admin-manajemen-buku');
    Route::get('/manajemen-kategori', AdminCategoryComp::class)->name('admin-manajemen-kategori');
    Route::get('/manajemen-penulis', AdminAuthorComp::class)->name('admin-manajemen-penulis');
    Route::get('/manajemen-pengunjung', AdminVisitorComp::class)->name('admin-manajemen-pengunjung');
    Route::get('/manajemen-peminjaman', AdminLoanTransactionComp::class)->name('admin-manajemen-peminjaman');
    Route::get('/manajemen-pengembalian', AdminLoanReturnComp::class)->name('admin-manajemen-pengembalian');
});
