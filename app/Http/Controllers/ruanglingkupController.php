<?php

namespace App\Http\Controllers;

use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ruanglingkupController extends Controller
{
    //
    public function index(){
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);
        
        $ruanglingkup = ruanglingkup::latest()->get();
        return view('MasterData.ruanglingkup.index',compact('ruanglingkup'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "keterangan" => "required|string",
        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0]);
        }
        try {
        $user = ruanglingkup::create([
            "nama_ruanglingkup" => $request->name,
            "keterangan" => $request->keterangan,
        ]);

        return redirect("kelola-ruang-lingkup")->with('success','Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
        return redirect("kelola-ruang-lingkup")->with('errors','Error'.$th);
        }

    }

    public function edit($id)
    {
        $data = ruanglingkup::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nama_ruanglingkup" => "required|string",
            "keterangan" => "required|string",
        ]);
        try {
            $data = ruanglingkup::findOrFail($id);
            $data->nama_ruanglingkup = $request->name;
            $data->keterangan = $request->keterangan;
            $data->save();
            return redirect("kelola-ruang-lingkup")->with('success', 'Data berhasil dirubah!');
        } catch (\Exception $e) {
            return redirect("kelola-ruang-lingkup")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data = ruanglingkup::find($id);
        if ($data) {
            $data->delete();
            return redirect("kelola-ruang-lingkup")->with(
                'success', 'Data berhasil dihapus.'
            );
        }
        return redirect("kelola-ruang-lingkup")->with(
            'error', 'Data tidak ditemukan.'
        );
    }

}
