<?php

namespace App\Http\Controllers;

use App\Models\jeniskerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class jenisKerjasamaController extends Controller
{
    //
    public function index()
    {
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);

        $jenis = jeniskerjasama::latest()->get();
        return view("MasterData.jeniskerjasama.index", compact("jenis"));
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
        $user = jeniskerjasama::create([
            "nama" => $request->name,
            "keterangan" => $request->keterangan,
        ]);

        return redirect("kelola-jenis-kerjasama")->with('success','Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
        return redirect("kelola-jenis-kerjasama")->with('errors','Error'.$th);
        }

    }

    public function edit($id)
    {
        $data = jeniskerjasama::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "keterangan" => "required|string",
        ]);
        try {
            $jenis = jeniskerjasama::findOrFail($id);
            $jenis->nama = $request->name;
            $jenis->keterangan = $request->keterangan;
            $jenis->save();
            return redirect("kelola-jenis-kerjasama")->with('success', 'Data berhasil dirubah!');
        } catch (\Exception $e) {
            return redirect("kelola-jenis-kerjasama")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        // $userCount = jeniskerjasama::count();
        // if ($userCount <= 1) {
        //     return redirect("kelola-jenis-kerjasama")->with(
        //         'error', 'Tidak bisa menghapus data, karena hanya ada satu pengguna.'
        //     );
        // }

        $data = jeniskerjasama::find($id);
        if ($data) {
            $data->delete();
            return redirect("kelola-jenis-kerjasama")->with(
                'success', 'Data berhasil dihapus.'
            );
        }
        return redirect("kelola-jenis-kerjasama")->with(
            'error', 'Data tidak ditemukan.'
        );
    }
}
