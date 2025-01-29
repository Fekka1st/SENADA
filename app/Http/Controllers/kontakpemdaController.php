<?php

namespace App\Http\Controllers;
use App\Models\datakerma_pemda;
use App\Models\kontakpemda;
use Illuminate\Http\Request;

class kontakpemdaController extends Controller
{
    //
    public function index($pemda_id){
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);

        $data_pemda = datakerma_pemda::where('id', $pemda_id)->select('id', 'nama_pemda')->first();
        $kontak = kontakpemda::with('pemda')->where('pemda_id', $pemda_id)->get();
        return view('kontak-pemda.index',compact('kontak','data_pemda'));
    }

    public function store(Request $request,$pemda_id)
    {
        try {
            $data = kontakpemda::create([
                "nama" => $request->nama,
                "jabatan" => $request->Jabatan,
                "no_hp" => $request->no_hp,
                "email" => $request->email,
                "alamat" => $request->alamat,
                "pemda_id" =>  $pemda_id,
            ]);
            return back()->with('success','Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return back()->with('errors','Error'.$th);
        }
    }

    public function edit($id)
    {
        try {
            $data = kontakpemda::findOrFail($id);
            return response()->json($data);
        } catch (\Throwable $th) {
            return back()->with('errors', 'Error: ' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kontak = kontakpemda::findOrFail($id);
            $kontak->update([
                "nama" => $request->nama,
                "jabatan" => $request->jabatan,
                "no_hp" => $request->no_hp,
                "email" => $request->email,
                "alamat" => $request->alamat,
            ]);
            return back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Throwable $th) {
            return back()->with('errors', 'Error: ' . $th->getMessage());
        }
    }
    public function destroy(string $id)
    {

        $data = kontakpemda::find($id);
        if ($data) {
            $data->delete();
               return back()->with('success', 'Data berhasil diperbarui!');
        }
        return redirect("kelola-jenis-mitra")->with(
            'error', 'Data tidak ditemukan.'
        );
    }

}
