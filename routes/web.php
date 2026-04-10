<?php

use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('area-parkir', AreaParkirController::class)->except(['show']);
        Route::resource('tarif', TarifController::class)->except(['show']);
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');

        // Kendaraan CRUD (create, edit, delete) — admin only
        Route::resource('kendaraan', KendaraanController::class)->except(['show', 'index']);
    });

    // Kendaraan list — accessible by admin & petugas
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    });

    // Petugas Routes
    Route::middleware('role:petugas')->group(function () {
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/transaksi/masuk', [TransaksiController::class, 'masuk'])->name('transaksi.masuk');
        Route::post('/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('transaksi.storeMasuk');
        Route::get('/transaksi/keluar', [TransaksiController::class, 'keluarForm'])->name('transaksi.keluar');
        Route::put('/transaksi/{transaksi}/keluar', [TransaksiController::class, 'prosesKeluar'])->name('transaksi.prosesKeluar');
        Route::get('/transaksi/{transaksi}/struk', [TransaksiController::class, 'cetakStruk'])->name('transaksi.struk');
    });

    // Owner Routes
    Route::middleware('role:owner')->group(function () {
        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
        Route::get('/rekap/export-csv', [RekapController::class, 'exportCsv'])->name('rekap.export-csv');
    });
});
