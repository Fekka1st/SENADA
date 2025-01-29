<?php

namespace App\Http\Controllers;

use App\Models\datakerma_pemda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class datakermapemdaController extends Controller
{
    public function index(){
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data? *Data yang dihapus tidak bisa dikembalikan beserta kontak pemda yang terkait";
        confirmDelete($title, $text);
        $datas = datakerma_pemda::all();
        return view('Kelola-kerma-pemda.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_pemda" => "required",
            "provinsi" => "required",
            "status" => "required",
        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0]);
        }
        try {
            $data = datakerma_pemda::create([
                "nama_pemda" => $request->nama_pemda,
                "provinsi" => $request->provinsi == 1 ? 'Provinsi Jawa Barat' : 'Provinsi Banten',
                "status" => $request->status,
                "join_grup" => $request->join_grup ?? 0,
            ]);
            return back()->with('success','Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return back()->with('errors','Error'.$th);
        }
    }

    public function edit($id)
    {
        $data = datakerma_pemda::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nama_pemda" => "required",
            "provinsi" => "required",
            "status" => "required",
        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0]);
        }
        try {
            $data = datakerma_pemda::findOrFail($id);
            $data->update([
                "nama_pemda" => $request->nama_pemda,
                "provinsi" => $request->provinsi == 1 ? 'Provinsi Jawa Barat' : 'Provinsi Banten',
                "status" => $request->status,
                "join_grup" => $request->join_grup ?? 0,
            ]);
            return back()->with('success','Data berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('errors','Error'.$th);
        }
    }

    public function destroy($id)
    {
        try {
            $data = datakerma_pemda::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return back()->with('errors', 'Error: ' . $th->getMessage());
        }
    }

}
