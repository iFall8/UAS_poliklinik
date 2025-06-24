<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Auth\RegisterController; 
use App\Http\Controllers\Pasien\PoliController as PasienPoliController; 
use App\Http\Controllers\Dokter\ProfilController;
use App\Http\Controllers\Dokter\RiwayatController;
use App\Http\Controllers\LandingController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

// Auth
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('poli', \App\Http\Controllers\Admin\PoliController::class);
    Route::resource('dokter', \App\Http\Controllers\Admin\DokterController::class);
    Route::resource('obat', \App\Http\Controllers\Admin\ObatController::class);
    Route::resource('pasien', \App\Http\Controllers\Admin\PasienController::class);
});

// Dokter
Route::middleware('auth:dokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
    Route::resource('jadwal', \App\Http\Controllers\Dokter\JadwalController::class);
    Route::resource('periksa', \App\Http\Controllers\Dokter\PeriksaController::class)->only(['index', 'edit', 'update']);
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/riwayat-pasien', [RiwayatController::class, 'index'])->name('riwayat.pasien');
});

// Pasien
Route::middleware('auth:pasien')->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
    Route::get('/poli', [PasienPoliController::class, 'index'])->name('poli.index');
    Route::post('/poli', [PasienPoliController::class, 'daftar'])->name('poli.daftar');
    Route::get('/riwayat', [PasienDashboardController::class, 'riwayat'])->name('riwayat');
});