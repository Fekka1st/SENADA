<?php

namespace App\Http\Controllers;

use App\Imports\Kelola_kerjasama_pts;
use App\Models\data_kerjasama_PT;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class datakerjasamaPT extends Controller
{
    //
    public function index(){
        $data_pt = data_kerjasama_PT::all();
        return view ('Kelola-KerjaSama-PTS.index',compact('data_pt'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new Kelola_kerjasama_pts, $request->file('file'));
            return redirect()->back()->with('success', 'Data Berhasil Di import!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' =>'Data Gagal Di import!']);
        }
    }

    public function store(){

    }
}
