<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Petani\DompetController;
use App\Http\Controllers\Admin\ValidasiSetoranController;
use App\Http\Controllers\Admin\DashboardAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    // GANTI RUTE DASHBOARD BAWAAN BREEZE MENJADI SEPERTI INI
    Route::get('/dashboard', function () {
        // Jika yang login admin, langsung oper (redirect) ke halaman statistik admin yang kamu buat
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Jika petani, tampilkan dashboard biasa bawaan Breeze
        return view('dashboard');
    })->name('dashboard');

    // Jalur Fitur Petani milikmu (Tetap Aman)
    Route::get('/dompet-poin', [DompetController::class, 'index'])->name('petani.dompet');

    // Jalur Fitur Admin yang kamu cicil (Tetap Aman)
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/validasi-setoran', [ValidasiSetoranController::class, 'index'])->name('admin.validasi.index');
    Route::patch('/admin/validasi-setoran/{id}', [ValidasiSetoranController::class, 'updateStatus'])->name('admin.validasi.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Route untuk Dompet Poin Petani
    Route::get('/dompet-poin', [DompetController::class, 'index'])->name('petani.dompet');
});

Route::middleware(['auth'])->group(function () {
    
    // Route Petani yang sudah kita buat kemarin
    Route::get('/dompet-poin', [DompetController::class, 'index'])->name('petani.dompet');

    // ROUTE ADMIN (Baru Ditambahkan)
    Route::get('/admin/validasi-setoran', [ValidasiSetoranController::class, 'index'])->name('admin.validasi.index');
    Route::patch('/admin/validasi-setoran/{id}', [ValidasiSetoranController::class, 'updateStatus'])->name('admin.validasi.update');
});

require __DIR__.'/auth.php';
