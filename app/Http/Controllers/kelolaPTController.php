<?php

namespace App\Http\Controllers;

use App\Imports\KelolaPT;
use App\Models\direktori_PT;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class kelolaPTController extends Controller
{
    //
    public function index(){
        try {
            $data_pt = direktori_PT::with(['kerjasama'])->get();
            return view ('Kelola-Data-PT.index',compact('data_pt'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' =>'Data Gagal Di Tampilkan!']);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new KelolaPT, $request->file('file'));
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' =>'Data Gagal Di import!']);
        }
    }
}
