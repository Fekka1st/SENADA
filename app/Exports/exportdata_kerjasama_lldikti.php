<?php

namespace App\Exports;

use App\Models\datamou;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportdata_kerjasama_lldikti implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
         // Ambil data dari database dan mapping untuk export
         return datamou::with(['jenisMitra', 'jenisKerjasama', 'statusDokumen'])->get()->map(function ($item) {
            return [
                'Nama Mitra' => $item->nama_mitra,
                'Perihal' => $item->perihal,
                'Nomor Agenda Mitra' => $item->nomor_agenda_mitra,
                'Nomor Agenda LLDIKTI' => $item->nomor_agenda_lldikti,
                'Tahun' => $item->tahun,
                'Jenis Mitra' => $item->jenisMitra->nama ?? '-', // Ambil nama dari relasi
                'Jenis Kerjasama' => $item->jenisKerjasama->nama ?? '-', // Ambil nama dari relasi
                'Status' => $item->statusDokumen->nama ?? '-', // Ambil nama dari relasi
                'Masa Berlaku' => $item->masa_berlaku,
                'Mulai Berlaku' => $item->mulai_berlaku,
                'Kadaluarsa' => $item->kadaluarsa,
                'Keterangan Dokumen' => $item->keterangan_dokumen,
                'Jenis File' => $item->jenis_file,
                'File' => $item->file, // Pastikan path valid jika file harus ditampilkan
                'Bentuk Tindak Lanjut' => $item->bentuk_tindak_lanjut,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Agenda Mitra',
            'Nomor Agenda LLDIKTI',
            'Nama Mitra',
            'Perihal',
            'Tahun',
            'Jenis Mitra',
            'Jenis Kerjasama',
            'Status',
            'Masa Berlaku',
            'Mulai Berlaku',
            'Kadaluarsa',
            'Keterangan Dokumen',
            'Jenis File',
            'File',
            'Bentuk Tindak Lanjut',
        ];
    }
}
