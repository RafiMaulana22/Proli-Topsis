<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\SubKriteriaController;
use App\Http\Controllers\Admin\TopsisController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Periode
    Route::resource('periode', PeriodeController::class);

    // Material
     Route::resource('material', MaterialController::class);

    // Kriteria
    Route::resource('kriteria', KriteriaController::class);

    // Sub Kriteria
    Route::resource('sub-kriteria', SubKriteriaController::class);

    // Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');

    // Topsis
    Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');

    // Hasil
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // User
    Route::resource('user', UserController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
