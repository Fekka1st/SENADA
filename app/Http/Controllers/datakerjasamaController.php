<?php

namespace App\Http\Controllers;

use App\Models\datamou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class datakerjasamaController extends Controller
{
    //
    public function index(){
        $datamou = datamou::all();
        return view('Data-KerjaSama-LLDIKTI.index',compact('datamou'));
    }

    public function create(){
        return view('Data-KerjaSama-LLDIKTI.tambah');
    }

    public function store(Request $request){
        try {
            $rules = [
                'nama_mitra' => 'required|string|max:128',
                'perihal' => 'required|string',
                'tahun' => 'required|integer',
                'jenis_mitra' => 'required|string|max:64',
                'jenis_kerjasama' => 'required|string|max:64',
                'masa_berlaku_mou_tahun' => 'required|integer',
                'mulai_berlaku' => 'required|date',
                'tanggal_kadaluarsa' => 'required|date',
                'nomor_agenda_mitra' => 'required|string',
                'nomor_agenda_lldikti' => 'required|string',
                'status_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
                'keterangan_dokumen' => 'nullable|string',
                'link_dokumen' => 'nullable|string',
                'bentuk_tindak_lanjut' => 'nullable|string',
                'jenis_file' => 'required'
            ];

            $messages = [
                'nama_mitra.required' => 'Nama Mitra wajib diisi.',
                'nama_mitra.string' => 'Nama Mitra harus berupa teks.',
                'nama_mitra.max' => 'Nama Mitra maksimal 128 karakter.',
                'perihal.required' => 'Perihal wajib diisi.',
                'perihal.string' => 'Perihal harus berupa teks.',
                'tahun.required' => 'Tahun wajib diisi.',
                'tahun.integer' => 'Tahun harus berupa angka.',
                'jenis_mitra.required' => 'Jenis Mitra wajib diisi.',
                'jenis_mitra.string' => 'Jenis Mitra harus berupa teks.',
                'jenis_mitra.max' => 'Jenis Mitra maksimal 64 karakter.',
                'jenis_kerjasama.required' => 'Jenis Kerjasama wajib diisi.',
                'jenis_kerjasama.string' => 'Jenis Kerjasama harus berupa teks.',
                'jenis_kerjasama.max' => 'Jenis Kerjasama maksimal 64 karakter.',
                'masa_berlaku_mou_tahun.required' => 'Masa Berlaku MOU (tahun) wajib diisi.',
                'masa_berlaku_mou_tahun.integer' => 'Masa Berlaku MOU (tahun) harus berupa angka.',
                'mulai_berlaku.required' => 'Tanggal Mulai Berlaku wajib diisi.',
                'mulai_berlaku.date' => 'Tanggal Mulai Berlaku harus berupa tanggal.',
                'tanggal_kadaluarsa.required' => 'Tanggal Kadaluarsa wajib diisi.',
                'tanggal_kadaluarsa.date' => 'Tanggal Kadaluarsa harus berupa tanggal.',
                'nomor_agenda_mitra.required' => 'Nomor Agenda Mitra wajib diisi.',
                'nomor_agenda_mitra.string' => 'Nomor Agenda Mitra harus berupa teks.',
                'nomor_agenda_lldikti.required' => 'Nomor Agenda LLDIKTI wajib diisi.',
                'nomor_agenda_lldikti.string' => 'Nomor Agenda LLDIKTI harus berupa teks.',
                'status_dokumen.required' => 'Status Dokumen wajib diisi.',
                'status_dokumen.in' => 'Status Dokumen hanya boleh diisi dengan "Lengkap" atau "Tidak Lengkap".',
                'keterangan_dokumen.string' => 'Keterangan Dokumen harus berupa teks.',
                'link_dokumen.string' => 'Link Dokumen harus berupa teks.',
                'bentuk_tindak_lanjut.string' => 'Bentuk Tindak Lanjut harus berupa teks.',
            ];
            $validatedData = $request->validate($rules, $messages);

            if ($validatedData['jenis_file'] === 'file') {
                if ($request->hasFile('file')) {
                    $originalName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $fileName = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;
                    $filePath = $request->file('file')->storeAs('uploads/mou', $fileName, 'public');
                    $validatedData['file'] = Storage::url($filePath);
                } else {
                    return redirect()->back()->withErrors(['file' => 'File harus diunggah jika jenis file adalah "file".']);
                }
            } elseif ($validatedData['jenis_file'] === 'googledrive') {
                if (empty($validatedData['file'])) {
                    return redirect()->back()->withErrors(['link_dokumen' => 'Link Google Drive harus diisi jika jenis file adalah "googledrive".']);
                }
            }
            datamou::create($validatedData);

            return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['database' => 'Terjadi kesalahan pada database: ' . $e->getMessage()]);
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
