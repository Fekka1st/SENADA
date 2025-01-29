<?php

namespace App\Http\Controllers;

use App\Exports\DataRuangLingkup;
use App\Models\datakerma_pemda;
use App\Models\kermapemdaruanglingkup;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class datakermapemdaruanglingkupController extends Controller
{
    //
    public function index (){
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);

        $datas = kermapemdaruanglingkup::with([
            'pemda:id,nama_pemda',
            'ruanglingkup:id,nama_ruanglingkup'
        ])->get();

        $datapemda = datakerma_pemda::all();
        $dataruanglingkup = ruanglingkup::all();

        return view('kelola-kerma-pemda-ruanglingkup.index',compact('datas','datapemda','dataruanglingkup'));
    }

    public function create(){
        $datapemda = datakerma_pemda::all();
        $dataruanglingkup = ruanglingkup::all();
        return view('kelola-kerma-pemda-ruanglingkup.tambah',compact('datapemda','dataruanglingkup'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_pemda' => 'required',
                'ruang_lingkup' => 'required',
                'nama_program' => 'required',
                'tgl_mulai' => 'required|date',
                'tgl_berakhir' => 'required|date',
                'kpi_program' => 'required',
                'pencapaian_program' => 'required',
                'evaluasi_program' => 'required',
                'dukungan_pihak_lain' => 'required',
            ]);

            $data = [
                'pemda_id' => $request->nama_pemda,
                'ruang_lingkup_id' => $request->ruang_lingkup,
                'nama_program' => $request->nama_program,
                'tgl_pelaksanaan_start' => $request->tgl_mulai,
                'tgl_pelaksanaan_end' => $request->tgl_berakhir,
                'kpi_program' => $request->kpi_program,
                'pencapaian_program' => $request->pencapaian_program,
                'evaluasi_program' => $request->evaluasi_program,
                'dukungan_pihak_lain' => $request->dukungan_pihak_lain,
            ];

            kermapemdaruanglingkup::create($data);
            return redirect()->route('kerma-pemda-ruanglingkup.index')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan '])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $datapemda = datakerma_pemda::all();
        $dataruanglingkup = ruanglingkup::all();
        $data = kermapemdaruanglingkup::findOrFail($id);
        return view('kelola-kerma-pemda-ruanglingkup.update', compact('data','datapemda','dataruanglingkup'));
    }



    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_pemda' => 'required',
                'ruang_lingkup' => 'required',
                'nama_program' => 'required',
                'tgl_mulai' => 'required|date',
                'tgl_berakhir' => 'required|date',
                'kpi_program' => 'required',
                'pencapaian_program' => 'required',
                'evaluasi_program' => 'required',
                'dukungan_pihak_lain' => 'required',
            ]);
            $kermaPemdaRuangLingkup = kermapemdaruanglingkup::findOrFail($id);
            $kermaPemdaRuangLingkup->update([
                'pemda_id' => $request->nama_pemda,
                'ruang_lingkup_id' => $request->ruang_lingkup,
                'nama_program' => $request->nama_program,
                'tgl_pelaksanaan_start' => $request->tgl_mulai,
                'tgl_pelaksanaan_end' => $request->tgl_berakhir,
                'kpi_program' => $request->kpi_program,
                'pencapaian_program' => $request->pencapaian_program,
                'evaluasi_program' => $request->evaluasi_program,
                'dukungan_pihak_lain' => $request->dukungan_pihak_lain,
            ]);
            return redirect()->route('kerma-pemda-ruanglingkup.index')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            kermapemdaruanglingkup::destroy($id);
            return redirect()->route('kerma-pemda-ruanglingkup.index')
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data']);
        }
    }

    public function detail($id)
    {
        $data = kermapemdaruanglingkup::with([
            'pemda',
            'ruanglingkup'
        ])->findOrFail($id);
        return view('kelola-kerma-pemda-ruanglingkup.detail', compact('data'));
    }

    public function export()
    {
        return Excel::download(new DataRuangLingkup, 'Data Kerma Pemda Ruang Lingkup '. date('Y-m-d_H-i-s').'.xlsx');
    }

}


