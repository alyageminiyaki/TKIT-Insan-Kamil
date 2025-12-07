<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

// --- PERBAIKAN DI SINI ---
// Kita beri nama panggilan agar tidak tertukar
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TagihanController as AdminTagihanController; // Alias untuk Admin
use App\Http\Controllers\WaliMurid\DashboardController as WaliMuridDashboardController;
use App\Http\Controllers\WaliMurid\TagihanController as WaliMuridTagihanController; // Alias untuk Wali Murid
use App\Http\Controllers\Admin\WaliMuridController as WaliMuridController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIKA PENGALIHAN SETELAH LOGIN
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == 'walimurid') {
        return redirect()->route('walimurid.dashboard');
    }
    abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');


// GRUP ROUTE UNTUK ADMIN
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);

    // --- PERBAIKAN DI SINI ---
    // Pastikan menunjuk ke AdminTagihanController
    Route::resource('tagihan', AdminTagihanController::class);

    Route::post('tagihan/{tagihan}/verifikasi', [AdminTagihanController::class, 'verifikasi'])->name('tagihan.verifikasi');
    Route::post('tagihan/{tagihan}/tolak', [AdminTagihanController::class, 'tolak'])->name('tagihan.tolak');

    // UNTUK MANAJEMEN WALI MURID
    Route::resource('walimurid', WaliMuridController::class);

    // UNTUK MANJEMEN LAPORAN
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [LaporanController::class, 'exportExcel'])->name('laporan.export');
});


// GRUP ROUTE UNTUK WALI MURID
Route::middleware(['auth', 'is_walimurid'])->prefix('walimurid')->name('walimurid.')->group(function () {

    Route::get('dashboard', [WaliMuridDashboardController::class, 'index'])->name('dashboard');

    // --- PERBAIKAN DI SINI ---
    // Gunakan alias WaliMuridTagihanController
    Route::get('tagihan', [WaliMuridTagihanController::class, 'index'])->name('tagihan.index');

    // TAMBAHKAN DUA ROUTE INI:
    // Route untuk menampilkan form bayar
    Route::get('tagihan/{tagihan}/bayar', [WaliMuridTagihanController::class, 'show'])->name('tagihan.show');
    // Route untuk memproses form bayar (upload bukti)
    Route::put('tagihan/{tagihan}', [WaliMuridTagihanController::class, 'update'])->name('tagihan.update');

    Route::get('tagihan/{tagihan}/kuitansi', [WaliMuridTagihanController::class, 'downloadKuitansi'])->name('tagihan.kuitansi');
});


// Rute bawaan Breeze untuk manajemen profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
