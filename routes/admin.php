<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datakerjasamaController;
use App\Http\Controllers\datakerjasamaPT;
use App\Http\Controllers\datakermapemdaController;
use App\Http\Controllers\datakermapemdaptsController;
use App\Http\Controllers\datakermapemdaruanglingkupController;
use App\Http\Controllers\kelolaPTController;
use App\Http\Controllers\kontakpemdaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:1,2'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    // // Profile Routes
    // Route::prefix('profile')->group(function () {
    //     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    Route::prefix('Data-KerjaSama-lldikti')->name('kerjasama-lldikti.')->group(function () {
        Route::get('/', [datakerjasamaController::class, 'index'])->name('index');
        Route::get('/tambah', [datakerjasamaController::class, 'create'])->name('create');
        Route::post('/import', [datakerjasamaController::class, 'import'])->name('import');
        Route::post('/store', [datakerjasamaController::class, 'store'])->name('store');
        Route::get('/sinkron', [datakerjasamaController::class, 'sinkron'])->name('sinkron');
        Route::delete('/delete/{id}', [datakerjasamaController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [datakerjasamaController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [datakerjasamaController::class, 'edit'])->name('edit');
        Route::get('/detail/{id}', [datakerjasamaController::class, 'detail'])->name('detail');
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

    Route::prefix('kelola-kermapemda')->name('kerma-pemda.')->group(function () {
        Route::get('/', [datakermapemdaController::class, 'index'])->name('index'); // Menampilkan data
        Route::post('/store', [datakermapemdaController::class, 'store'])->name('store'); // Simpan data baru // Proses import data
        Route::get('/{id}/edit', [datakermapemdaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [datakermapemdaController::class, 'update'])->name('update');
        Route::post('/import', [datakermapemdaController::class, 'import'])->name('import');
        Route::delete('/delete/{id}', [datakermapemdaController::class, 'destroy'])->name('destroy');

        Route::prefix('kontakpemda')->name('kontakpemda.')->group(function () {
            Route::get('/{pemda_id}', [kontakpemdaController::class, 'index'])->name('index'); // Menampilkan kontak untuk pemda tertentu
            Route::post('/store/{pemda_id}', [kontakpemdaController::class, 'store'])->name('store'); // Simpan kontak baru
            Route::get('/{id}/edit', [kontakpemdaController::class, 'edit'])->name('edit'); // Edit kontak
            Route::put('/update/{id}', [kontakpemdaController::class, 'update'])->name('update'); // Update kontak
            Route::delete('/delete/{id}', [kontakpemdaController::class, 'destroy'])->name('destroy'); // Hapus kontak
        });
    });

    Route::prefix('kerma-pemda-ruang-lingkup')->name('kerma-pemda-ruanglingkup.')->group(function () {
        Route::get('/', [datakermapemdaruanglingkupController::class, 'index'])->name('index');
        Route::get('/tambah', [datakermapemdaruanglingkupController::class, 'create'])->name('create');
        Route::post('/store', [datakermapemdaruanglingkupController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [datakermapemdaruanglingkupController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [datakermapemdaruanglingkupController::class, 'update'])->name('update');
        Route::get('/export', [datakermapemdaruanglingkupController::class, 'export'])->name('export');
        Route::delete('/delete/{id}', [datakermapemdaruanglingkupController::class, 'destroy'])->name('destroy');
        Route::get('/detail/{id}', [datakermapemdaruanglingkupController::class, 'detail'])->name('detail');
    });

    Route::prefix('kelola-kerma-pemda-pts')->name('kerma-pemda-pts.')->group(function () {
        Route::get('/', [datakermapemdaptsController::class, 'index'])->name('index');
        Route::get('/tambah', [datakermapemdaptsController::class, 'create'])->name('create');
        Route::post('/store', [datakermapemdaptsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [datakermapemdaptsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [datakermapemdaptsController::class, 'update'])->name('update');
        Route::post('/import', [datakermapemdaptsController::class, 'import'])->name('import');
        Route::get('/export', [datakermapemdaptsController::class, 'export'])->name('export');
        Route::delete('/delete/{id}', [datakermapemdaptsController::class, 'destroy'])->name('destroy');
        Route::get('/api/nama-univ', [datakermapemdaptsController::class, 'getNamaUniv'])->name('namauniv');
    });
});
