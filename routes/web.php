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
    Route::resource('kelola-jenis-kerjasama',jenisKerjasamaController::class);
    Route::resource('kelola-jenis-mitra', jenisMitraController::class);
    Route::resource('kelola-status-dokument', statusDokumentController::class);
//    Route::resource('/manajemen_user', manajemenuser::class);
});

Route::middleware(['auth','role:1,2'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard');
    // Route::resource('Data-KerjaSama-lldikti', datakerjasamaController::class);
    // Route::resource('Kelola-PT',kelolaPTController::class);\

    Route::get('/Data-KerjaSama-lldikti',[datakerjasamaController::class,'index'])->name('kerjasama-lldikti.index');
    Route::post('/Data-KerjaSama-lldikti/tambah',[datakerjasamaController::class,'create'])->name('kerjasama-lldikti.create');
    Route::post('/Data-KerjaSama-lldikti/import',[datakerjasamaController::class,'import'])->name('kerjasama-lldikti.import');
    Route::post('/Data-KerjaSama-lldikti/store',[datakerjasamaController::class,'store'])->name('kerjasama-lldikti.store');

    Route::get('/Data-KerjaSama-pts', [datakerjasamaPT::class,'index'])->name('kerjasama-pts.index');
    Route::post('/Data-KerjaSama-pts/store', [datakerjasamaPT::class,'store'])->name('kerjasama-pts.store');
    Route::post('/Data-KerjaSama-pts/import',[datakerjasamaPT::class,'import'])->name('kerjasama-pts.import');

    Route::get('/kelola-PT',[kelolaPTController::class,'index'])->name('kelola-pt.index');
    Route::post('/kelola-PT/store',[kelolaPTController::class,'store'])->name('kelola-pt.store');
    Route::post('/kelola-PT/import',[kelolaPTController::class,'import'])->name('kelola-pt.import');

});

require __DIR__.'/auth.php';
