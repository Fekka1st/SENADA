<?php

namespace App\Http\Controllers;

use App\Exports\exportdata_kerjasama_lldikti;
use App\Imports\kelola_kerjasama_lldikti;
use App\Models\datamou;
use App\Models\direktori_PT;
use App\Models\jeniskerjasama;
use App\Models\jenismitra;
use App\Models\statusdokument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class datakerjasamaController extends Controller
{
    //
    public function index(){
        $datamou = DB::table('data_mous')
        ->join('statusdokuments', 'data_mous.status', '=', 'statusdokuments.id')
        ->join('jenismitras', 'data_mous.jenis_mitra', '=', 'jenismitras.id')
        ->join('jeniskerjasamas', 'data_mous.jenis_kerjasama', '=', 'jeniskerjasamas.id')
        ->select('data_mous.*', 'statusdokuments.nama AS status_nama', 'jenismitras.nama AS jenis_mitra_nama', 'jeniskerjasamas.nama AS jenis_kerjasama_nama')
        ->orderBy('data_mous.updated_at', 'desc')
        ->get();

        $status = statusdokument::all();
        $jenismitra = jenismitra::all();
        $jeniskerjasama = jeniskerjasama::all();
        return view('Data-KerjaSama-LLDIKTI.index',compact('datamou','status','jenismitra','jeniskerjasama'));
    }

    public function create(){
        $status = statusdokument::all();
        $jenismitra = jenismitra::all();
        $jeniskerjasama = jeniskerjasama::all();
        return view('Data-KerjaSama-LLDIKTI.tambah',compact('status','jenismitra','jeniskerjasama'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new kelola_kerjasama_lldikti, $request->file('file'));
            return redirect()->back()->with('success', 'Data Berhasil Di import!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' =>'Data Gagal Di import!']);
        }
    }

    public function store(Request $request){


        try {
            $rules = [
                'nama_mitra' => 'required|string|max:128',
                'perihal' => 'required|string',
                'tahun' => 'required|integer',
                'jenis_mitra' => 'required',
                'jenis_kerjasama' => 'required',
                'masa_berlaku_mou_tahun' => 'required|integer',
                'mulai_berlaku' => 'required|date',
                'tanggal_kadaluarsa' => 'required|date',
                'nomor_agenda_mitra' => 'required|string',
                'nomor_agenda_lldikti' => 'required|string',
                'status_dokumen' => 'required|string|max:64',
                'keterangan_dokumen' => 'nullable|string',
                'link_dokument' => 'nullable|string',
                'bentuk_tindak_lanjut' => 'nullable|string',
                'jenis_file' => 'required',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Batasan file
            ];

            $messages = [
                'nama_mitra.required' => 'Nama Mitra wajib diisi.',
                'perihal.required' => 'Perihal wajib diisi.',
                'tahun.required' => 'Tahun wajib diisi.',
                'tahun.integer' => 'Tahun harus berupa angka.',
                'jenis_mitra.required' => 'Jenis Mitra wajib diisi.',
                'jenis_kerjasama.required' => 'Jenis Kerjasama wajib diisi.',
                'masa_berlaku_mou_tahun.required' => 'Masa Berlaku MoU wajib diisi.',
                'mulai_berlaku.required' => 'Tanggal Mulai Berlaku wajib diisi.',
                'tanggal_kadaluarsa.required' => 'Tanggal Kadaluarsa wajib diisi.',
                'nomor_agenda_mitra.required' => 'Nomor Agenda Mitra wajib diisi.',
                'nomor_agenda_lldikti.required' => 'Nomor Agenda LLDIKTI wajib diisi.',
                'status_dokumen.required' => 'Status Dokumen wajib diisi.',
                'jenis_file.required' => 'Jenis File wajib diisi.',
                'file.mimes' => 'File harus berupa PDF, DOC, atau DOCX.',
                'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            ];

            // Validasi data
            $validatedData = $request->validate($rules, $messages);
            // Proses file jika jenis file adalah "file"
            if ($validatedData['jenis_file'] === 'file_upload') {
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '_' . now()->format('Ymd_His')
                        . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/mou', $fileName, 'public');
                    $validatedData['file'] = Storage::url($filePath);
                } else {
                    return redirect()->back()->withErrors(['file' => 'File harus diunggah jika jenis file adalah "file".']);
                }
            } elseif ($validatedData['jenis_file'] === 'google_drive') {
                if (empty($validatedData['link_dokument'])) {
                    return redirect()->back()->withErrors(['link_dokument' => 'Link Google Drive harus diisi jika jenis file adalah "googledrive".']);
                }
                $validatedData['file'] = $validatedData['link_dokument'];
            }

            // dd($validatedData);
            datamou::create([
                'nomor_agenda_mitra' => $validatedData['nomor_agenda_mitra'],
                'nomor_agenda_lldikti' => $validatedData['nomor_agenda_lldikti'],
                'nama_mitra' => $validatedData['nama_mitra'],
                'perihal' => $validatedData['perihal'],
                'tahun' => $validatedData['tahun'],
                'jenis_mitra' => $validatedData['jenis_mitra'],
                'jenis_kerjasama' => $validatedData['jenis_kerjasama'],
                'status' => $validatedData['status_dokumen'],
                'masa_berlaku' => $validatedData['masa_berlaku_mou_tahun'],
                'mulai_berlaku' => $validatedData['mulai_berlaku'],
                'kadaluarsa' => $validatedData['tanggal_kadaluarsa'],
                'keterangan_dokumen' => $validatedData['keterangan_dokumen'] ?? '-',
                'jenis_file' => $validatedData['jenis_file'],
                'file' => $validatedData['file'] ??  $validatedData['link_dokument'],
                'bentuk_tindak_lanjut' => $validatedData['bentuk_tindak_lanjut'] ?? '-',
            ]);

            return redirect()->route('kerjasama-lldikti.index')->with('success', 'Data MoU berhasil disimpan.');
        } catch (\Throwable $e) {
            Log::error('Error saat menyimpan data MoU: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan pada database: ' . $e->getMessage()]);
        }
    }

    public function edit($id){
        $data = datamou::find($id);
        return view('kerjasama-lldikti.update',compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'nama_mitra' => 'required|string|max:128',
                'perihal' => 'required|string',
                'tahun' => 'required|integer',
                'jenis_mitra' => 'required',
                'jenis_kerjasama' => 'required',
                'masa_berlaku_mou_tahun' => 'required|integer',
                'mulai_berlaku' => 'required|date',
                'tanggal_kadaluarsa' => 'required|date',
                'nomor_agenda_mitra' => 'required|string',
                'nomor_agenda_lldikti' => 'required|string',
                'status_dokumen' => 'required|string|max:64',
                'keterangan_dokumen' => 'nullable|string',
                'link_dokument' => 'nullable|string',
                'bentuk_tindak_lanjut' => 'nullable|string',
                'jenis_file' => 'required',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ];

            $messages = [
                'nama_mitra.required' => 'Nama Mitra wajib diisi.',
                'perihal.required' => 'Perihal wajib diisi.',
                'tahun.required' => 'Tahun wajib diisi.',
                'tahun.integer' => 'Tahun harus berupa angka.',
                'jenis_mitra.required' => 'Jenis Mitra wajib diisi.',
                'jenis_kerjasama.required' => 'Jenis Kerjasama wajib diisi.',
                'masa_berlaku_mou_tahun.required' => 'Masa Berlaku MoU wajib diisi.',
                'mulai_berlaku.required' => 'Tanggal Mulai Berlaku wajib diisi.',
                'tanggal_kadaluarsa.required' => 'Tanggal Kadaluarsa wajib diisi.',
                'nomor_agenda_mitra.required' => 'Nomor Agenda Mitra wajib diisi.',
                'nomor_agenda_lldikti.required' => 'Nomor Agenda LLDIKTI wajib diisi.',
                'status_dokumen.required' => 'Status Dokumen wajib diisi.',
                'jenis_file.required' => 'Jenis File wajib diisi.',
                'file.mimes' => 'File harus berupa PDF, DOC, atau DOCX.',
                'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $data = datamou::findOrFail($id);

            if ($validatedData['jenis_file'] === 'file_upload') {
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '_' . now()->format('Ymd_His')
                        . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/mou', $fileName, 'public');
                    $validatedData['file'] = Storage::url($filePath);

                    if ($data->jenis_file === 'file_upload') {
                        $oldFilePath = str_replace('/storage', 'public', $data->file);
                        if (Storage::exists($oldFilePath)) {
                            Storage::delete($oldFilePath);
                        }
                    }
                } else {
                    return redirect()->back()->withErrors(['file' => 'File harus diunggah jika jenis file adalah "file".']);
                }
            } elseif ($validatedData['jenis_file'] === 'google_drive') {
                if (empty($validatedData['link_dokument'])) {
                    return redirect()->back()->withErrors(['link_dokument' => 'Link Google Drive harus diisi jika jenis file adalah "googledrive".']);
                }
                $validatedData['file'] = $validatedData['link_dokument'];
            }

            $data->update([
                'nomor_agenda_mitra' => $validatedData['nomor_agenda_mitra'],
                'nomor_agenda_lldikti' => $validatedData['nomor_agenda_lldikti'],
                'nama_mitra' => $validatedData['nama_mitra'],
                'perihal' => $validatedData['perihal'],
                'tahun' => $validatedData['tahun'],
                'jenis_mitra' => $validatedData['jenis_mitra'],
                'jenis_kerjasama' => $validatedData['jenis_kerjasama'],
                'status' => $validatedData['status_dokumen'],
                'masa_berlaku' => $validatedData['masa_berlaku_mou_tahun'],
                'mulai_berlaku' => $validatedData['mulai_berlaku'],
                'kadaluarsa' => $validatedData['tanggal_kadaluarsa'],
                'keterangan_dokumen' => $validatedData['keterangan_dokumen'] ?? '-',
                'jenis_file' => $validatedData['jenis_file'],
                'file' => $validatedData['file'] ?? $validatedData['link_dokument'],
                'bentuk_tindak_lanjut' => $validatedData['bentuk_tindak_lanjut'] ?? '-',
            ]);

            return redirect()->route('kerjasama-lldikti.index')->with('success', 'Data MoU berhasil diperbarui.');
        } catch (\Throwable $e) {
            Log::error('Error saat memperbarui data MoU: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan pada database: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = datamou::findOrFail($id);

            if ($data->jenis_file === 'file_upload') {
                $filePath = str_replace('/storage', 'public', $data->file);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }

            $data->delete();

            return redirect()->route('kerjasama-lldikti.index')->with('success', 'Data MoU berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Error saat menghapus data MoU: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan pada database: ' . $e->getMessage()]);
        }
    }

    public function exportCustom(){
    try {
        return Excel::download(new exportdata_kerjasama_lldikti, 'data_mou_custom.xlsx');
    } catch (\Throwable $e) {
         Log::error('Error saat mengekspor data MoU: ' . $e->getMessage(), [
        'trace' => $e->getTraceAsString()
    ]);
        return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage()]);
    }
}

// public function exportSelected(Request $request)
// {
//     try {
//         $selectedIds = $request->input('selected_ids', []);
//         if (empty($selectedIds)) {
//             return redirect()->back()->withErrors(['error' => 'Tidak ada data yang dipilih untuk diekspor.']);
//         }

//         $data = datamou::whereIn('id', $selectedIds)->get();
//         $exportData = $data->map(function ($item) {
//             return [
//                 'Nomor Agenda Mitra' => $item->nomor_agenda_mitra,
//                 'Nomor Agenda LLDIKTI' => $item->nomor_agenda_lldikti,
//                 'Nama Mitra' => $item->nama_mitra,
//                 'Perihal' => $item->perihal,
//                 'Tahun' => $item->tahun,
//                 'Jenis Mitra' => $item->jenis_mitra,
//                 'Jenis Kerjasama' => $item->jenis_kerjasama,
//                 'Status' => $item->status,
//                 'Masa Berlaku' => $item->masa_berlaku,
//                 'Mulai Berlaku' => $item->mulai_berlaku,
//                 'Kadaluarsa' => $item->kadaluarsa,
//                 'Keterangan Dokumen' => $item->keterangan_dokumen,
//                 'Jenis File' => $item->jenis_file,
//                 'File' => $item->file,
//                 'Bentuk Tindak Lanjut' => $item->bentuk_tindak_lanjut,
//             ];
//         });

//         return Excel::download(new \App\Exports\CustomExport($exportData), 'data_mou_selected.xlsx');
//     } catch (\Throwable $e) {
//         Log::error('Error saat mengekspor data MoU: ' . $e->getMessage(), [
//             'trace' => $e->getTraceAsString()
//         ]);
//         return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage()]);
//     }
// }



}
