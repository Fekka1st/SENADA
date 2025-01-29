<?php

use App\Http\Controllers\datakermapemdaController;
use App\Http\Controllers\jenisKerjasamaController;
use App\Http\Controllers\jenisMitraController;
use App\Http\Controllers\manajemenUserController;
use App\Http\Controllers\ruanglingkupController;
use App\Http\Controllers\statusDokumentController;
use Illuminate\Support\Facades\Route;





Route::middleware(['role:1'])->group(function () {
    Route::resource('manajemen-user', manajemenUserController::class);
    Route::patch('manajemen-user/{id}/update', [manajemenUserController::class,'update']);
    Route::resource('kelola-jenis-kerjasama',jenisKerjasamaController::class);
    Route::resource('kelola-jenis-mitra', jenisMitraController::class);
    Route::resource('kelola-status-dokument', statusDokumentController::class);
    Route::resource('kelola-ruang-lingkup', ruanglingkupController::class);
    
    Route::prefix('kelola-kerma-pemda')->name('kerma-pemda.')->group(function () {
        Route::delete('/delete/{id}', [datakermapemdaController::class, 'destroy'])->name('destroy');
    });
});
