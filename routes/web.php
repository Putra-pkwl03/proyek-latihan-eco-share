<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Petani\DompetController;
use App\Http\Controllers\Petani\SetoranLimbahController;
use App\Http\Controllers\Admin\ValidasiSetoranController;
use App\Http\Controllers\Admin\DistribusiController;
use App\Http\Controllers\Admin\KonversiEnergiController;
use App\Http\Controllers\Admin\PetaniController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    // A. DASHBOARD - Logika dipindahkan ke DashboardController atau tetap di sini tapi diringkas
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            // Kita hanya ambil data dari model StokBiomassa yang sudah terupdate otomatis
            $data = \App\Models\StokBiomassa::all();
            $totalSawit = $data->where('jenis_limbah', 'kelapa sawit')->value('total_berat') ?? 0;
            $totalPadi = $data->where('jenis_limbah', 'sekam padi')->value('total_berat') ?? 0;
            $totalStokGudang = $totalSawit + $totalPadi;
            
            return view('dashboard', compact('totalStokGudang', 'totalSawit', 'totalPadi'));
        }
        return view('dashboard');
    })->name('dashboard');

    // B. FITUR PETANI
    Route::prefix('petani')->group(function () {
        Route::get('/setoran', [SetoranLimbahController::class, 'index'])->name('petani.setoran.index');
        Route::get('/setoran/create', [SetoranLimbahController::class, 'create'])->name('petani.setoran.create');
        Route::post('/setoran', [SetoranLimbahController::class, 'store'])->name('petani.setoran.store');
        Route::get('/setoran/{id}/edit', [SetoranLimbahController::class, 'edit'])->name('petani.setoran.edit');
        Route::put('/setoran/{id}', [SetoranLimbahController::class, 'update'])->name('petani.setoran.update');
        Route::delete('/setoran/{id}', [SetoranLimbahController::class, 'destroy'])->name('petani.setoran.destroy');
    });
    Route::get('/dompet-poin', [DompetController::class, 'index'])->name('petani.dompet');

    // C. FITUR ADMIN

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Validasi Setoran
    Route::get('/validasi-setoran', [ValidasiSetoranController::class, 'index'])->name('validasi.index');
    Route::patch('/validasi-setoran/{id}', [ValidasiSetoranController::class, 'updateStatus'])->name('validasi.update');

    // 2. Distribusi Biomassa
    Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi.index');
    Route::post('/distribusi', [DistribusiController::class, 'store'])->name('distribusi.store');
    Route::delete('/distribusi/{id}', [DistribusiController::class, 'destroy'])->name('distribusi.destroy');

    // 3. Distribusi Energi (Fitur yang tadi tidak bisa diklik)
    Route::get('/energi', [KonversiEnergiController::class, 'index'])->name('energi.index');
    Route::post('/energi', [KonversiEnergiController::class, 'store'])->name('energi.store');

    // 4. Petani & Laporan
    Route::get('/petani', [PetaniController::class, 'index'])->name('petani.index');
// Ganti baris laporan yang lama dengan ini:
Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [App\Http\Controllers\Admin\LaporanController::class, 'cetak'])->name('laporan.cetak');
});

    // D. PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

