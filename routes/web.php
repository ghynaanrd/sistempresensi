<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Halaman Login (Tamu yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login'); // Akses root langsung ke login
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Route untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Setelah Login (Sementara kita buat dummy dulu biar tidak error 404)
Route::middleware('auth')->group(function () {
    
    // Rute Khusus Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('admin/karyawan', App\Http\Controllers\KaryawanController::class);
        Route::get('/admin/rekap', [App\Http\Controllers\AdminPresensiController::class, 'index'])->name('admin.rekap');
        // Route Edit & Hapus Presensi
        Route::get('/admin/presensi/{id}/edit', [App\Http\Controllers\AdminPresensiController::class, 'edit'])->name('presensi.edit');
        Route::put('/admin/presensi/{id}', [App\Http\Controllers\AdminPresensiController::class, 'update'])->name('presensi.update');
        Route::delete('/admin/presensi/{id}', [App\Http\Controllers\AdminPresensiController::class, 'destroy'])->name('presensi.destroy');
        });

    // Rute Khusus Karyawan
Route::middleware('role:karyawan')->group(function () {
    
    // Dashboard Karyawan (Halaman Absen)
    Route::get('/karyawan/dashboard', [App\Http\Controllers\PresensiController::class, 'index'])->name('karyawan.dashboard');
    
    // Proses Absen Masuk
    Route::post('/presensi/masuk', [App\Http\Controllers\PresensiController::class, 'store'])->name('presensi.store');
    Route::post('/presensi/pulang', [App\Http\Controllers\PresensiController::class, 'pulang'])->name('presensi.pulang');
    Route::get('/karyawan/riwayat', [App\Http\Controllers\PresensiController::class, 'riwayat'])->name('karyawan.riwayat');
    });
    
});