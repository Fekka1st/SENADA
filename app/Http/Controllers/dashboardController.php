<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('dashboard');
        }
        return abort(403, 'Tidak Mendapatkan Akses.');
    }
}

