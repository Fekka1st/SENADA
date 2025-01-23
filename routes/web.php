<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datakerjasamaController;
use App\Http\Controllers\datakerjasamaPT;
use App\Http\Controllers\jenisKerjasamaController;
use App\Http\Controllers\jenisMitraController;
use App\Http\Controllers\kelolaPTController;
use App\Http\Controllers\manajemenUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\statusDokumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth','role:1'])->group(function () {
    Route::resource('manajemen-user', manajemenUserController::class);
    Route::patch('manajemen-user/{id}/update', [manajemenUserController::class,'update']);
    Route::resource('kelola-jenis-kerjasama',jenisKerjasamaController::class);
    Route::resource('kelola-jenis-mitra', jenisMitraController::class);
    Route::resource('kelola-status-dokument', statusDokumentController::class);
});



Route::middleware(['auth', 'role:1,2'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // // Profile Routes
    // Route::prefix('profile')->group(function () {
    //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    // Data Kerja Sama LLDIKTI Routes
    Route::prefix('Data-KerjaSama-lldikti')->name('kerjasama-lldikti.')->group(function () {
        Route::get('/', [datakerjasamaController::class, 'index'])->name('index'); // Menampilkan data
        Route::get('/tambah', [datakerjasamaController::class, 'create'])->name('create'); // Form tambah data
        Route::post('/import', [datakerjasamaController::class, 'import'])->name('import'); // Proses import data
        Route::post('/store', [datakerjasamaController::class, 'store'])->name('store'); // Simpan data baru
        Route::get('/sinkron', [datakerjasamaController::class, 'sinkron'])->name('sinkron'); // Sinkronisasi data
        Route::delete('/delete/{id}', [datakerjasamaController::class, 'destroy'])->name('destroy'); // Hapus data
        Route::put('/update/{id}', [datakerjasamaController::class, 'update'])->name('update'); // Update data
        Route::get('/edit/{id}', [datakerjasamaController::class, 'edit'])->name('edit'); // Form edit data
        Route::get('/detail/{id}', [datakerjasamaController::class, 'detail'])->name('detail'); // Lihat detail data
        Route::get('/export', [datakerjasamaController::class, 'exportCustom'])->name('exportCustom');
        Route::get('/download/{id}', [datakerjasamaController::class, 'download'])->name('download');
    });

    // Data Kerja Sama PTS Routes
    Route::prefix('Data-KerjaSama-pts')->name('kerjasama-pts.')->group(function () {
        Route::get('/', [datakerjasamaPT::class, 'index'])->name('index'); // Menampilkan data
        Route::post('/store', [datakerjasamaPT::class, 'store'])->name('store'); // Simpan data baru
        Route::post('/import', [datakerjasamaPT::class, 'import'])->name('import'); // Proses import data
    });

    // Kelola PT Routes
    Route::prefix('kelola-PT')->name('kelola-pt.')->group(function () {
        Route::get('/', [kelolaPTController::class, 'index'])->name('index'); // Menampilkan data
        Route::post('/store', [kelolaPTController::class, 'store'])->name('store'); // Simpan data baru
        Route::post('/import', [kelolaPTController::class, 'import'])->name('import'); // Proses import data
    });

});

require __DIR__.'/auth.php';
