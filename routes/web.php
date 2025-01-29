<?php

use App\Http\Controllers\jenisKerjasamaController;
use App\Http\Controllers\jenisMitraController;
use App\Http\Controllers\manajemenUserController;
use App\Http\Controllers\ruanglingkupController;
use App\Http\Controllers\statusDokumentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/login');
// });


Route::middleware(['auth'])->group(function () {
    require __DIR__.'/superadmin.php';
    require __DIR__.'/admin.php';
});

require __DIR__.'/auth.php';
