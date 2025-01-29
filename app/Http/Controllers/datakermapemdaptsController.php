<?php

namespace App\Http\Controllers;

use App\Exports\datapemdaPTS;
use App\Imports\datakermapts;
use App\Models\datakerma_pemda;
use App\Models\direktori_PT;
use App\Models\kermapemdapts;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class datakermapemdaptsController extends Controller
{

    public function index()
    {
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);
        $mitra = datakerma_pemda::select('id', 'nama_pemda')->get();
        $datas = kermapemdapts::with(["pemda:id,nama_pemda"])->get();
        return view("kelola-kerma-pemda-pts.index", compact("datas", "mitra"));
    }

    public function create()
    {
        $datapemda = datakerma_pemda::all();
        $dataruanglingkup = ruanglingkup::all();
        return view(
            "kelola-kerma-pemda-pts.tambah",
            compact("datapemda", "dataruanglingkup")
        );
    }

    public function store(Request $request)
    {
        $namaMitra = $request->input("nama_pemda");
        $dataMitra = $request->input("data_mitra");

        foreach ($dataMitra as $mitra) {
            kermapemdapts::create([
                "pemda_id" => $namaMitra,
                "nama_pt" => $mitra["nama_pt"],
                "tahun_kerjasama" => $mitra["tahun"],
                "jangka_waktu" => $mitra["jangka_waktu"],
            ]);
        }

        return redirect()
            ->route("kerma-pemda-pts.index")
            ->with("success", "Data berhasil disimpan!");
    }

    public function getNamaUniv(Request $request)
    {
        try {
            $validated = $request->validate([
                "term" => "required|string|min:2",
            ]);
            $term = $validated["term"];
            $data = direktori_PT::where("nama_pt", "LIKE", "%" . $term . "%")
                ->take(10)
                ->get();
            $data = $data->map(function ($item) {
                return [
                    "nama_pt" => e($item->nama_pt),
                ];
            });
            return response()->json($data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(
                [
                    "error" => "Input tidak valid.",
                    "message" => $e->getMessage(),
                ],
                422
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "error" =>
                        "Terjadi kesalahan saat mengambil data universitas.",
                    "message" => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function edit($id)
    {
        $data = kermapemdapts::findOrFail($id);
        return response()->json($data);
    }

        public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_pemda' => 'required',
                'namapt' => 'required|string|max:255',
                'tahunkerjasama' => 'required|integer|min:1900',
                'jangkawaktu' => 'required|string|max:255',
            ]);
            $kerma = kermapemdapts::findOrFail($id);
            $kerma->update([
                'pemda_id' => $request->nama_pemda,
                'nama_pt' => $request->namapt,
                'tahun_kerjasama' => $request->tahunkerjasama,
                'jangka_waktu' => $request->jangkawaktu,
            ]);
            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e ]);
        }
    }

    public function destroy($id)
    {
        try {
            kermapemdapts::destroy($id);
            return redirect()
                ->route("kerma-pemda-pts.index")
                ->with("success", "Data berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    "error" => "Terjadi kesalahan saat menghapus data",
                ]);
        }
    }
    public function detail($id)
    {
        $data = kermapemdapts::with(["pemda"])->findOrFail($id);
        return view("kelola-kerma-pemda-pts.detail", compact("data"));
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new datakermapts, $request->file('file'));
            return redirect()->back()->with('success', 'Data Berhasil Di import!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' =>'Data Gagal Di import!']);
        }
    }

    public function export()
    {
        return Excel::download(new datapemdaPTS(),"Data Kerma PT " . date("Y-m-d_H-i-s") . ".xlsx");
    }
}
