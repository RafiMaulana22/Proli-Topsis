<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\ProfileController;
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
    Route::resource('penilaian', PenilaianController::class);

    // Topsis
    Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');
    Route::post('/topsis/proses', [TopsisController::class, 'proses'])->name('topsis.proses');

    // Hasil
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::get('/hasil/pdf', [HasilController::class, 'exportPdf'])->name('hasil.pdf');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');

    // User
    Route::resource('user', UserController::class);

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
