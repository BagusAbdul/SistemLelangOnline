<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriController;

// --- GUEST ROUTES (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/', [KatalogController::class, 'index'])->name('landing');
});

// --- AUTH ROUTES (Harus login) ---
Route::middleware('auth')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('DashboardAdmin');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'destroy']);

    // Manajemen Barang (CRUD)
    Route::resource('barang', BarangController::class);
    Route::resource('lelang', LelangController::class);
    Route::post('/lelang/{id}/tutup', [LelangController::class, 'tutupLelang'])->name('lelang.tutup');
    Route::get('/laporan', [LelangController::class, 'laporan'])->name('lelang.laporan');

    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{id}', [KatalogController::class, 'detail'])->name('katalog.detail');
    Route::post('/katalog/{id}/bid', [KatalogController::class, 'bid'])->name('lelang.bid');
    Route::get('/my-history', [KatalogController::class, 'history'])->name('masyarakat.history');

});
