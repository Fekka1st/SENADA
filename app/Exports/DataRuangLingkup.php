<?php

namespace App\Exports;

use App\Models\kermapemdaruanglingkup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class DataRuangLingkup implements FromCollection, WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return kermapemdaruanglingkup::with(['pemda', 'ruanglingkup'])->get()->map(function ($item,$index) {
            return [
                'No' => $index + 1,
                'Nama Mitra' => $item->pemda->nama_pemda ?? '-',
                'Jenis Ruang Lingkup' => $item->ruanglingkup->nama_ruanglingkup ?? '-',
                'Nama Program' => $item->nama_program,
                'Tanggal Mulai Pelaksanaan' => $item->tgl_pelaksanaan_start,
                'Tanggal Selesai Pelaksanaan' => $item->tgl_pelaksanaan_end,
                'KPI Program' => $item->kpi_program ?? '-',
                'Pencapaian Program' => $item->pencapaian_program ?? '-',
                'Evaluasi Program' => $item->evaluasi_program ?? '-',
                'Dukungan Pihak Lain' => $item->dukungan_pihak_lain ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Mitra',
            'Jenis Ruang Lingkup',
            'Nama Program',
            'Tanggal Mulai Pelaksanaan',
            'Tanggal Selesai Pelaksanaan',
            'KPI Program',
            'Pencapaian Program',
            'Evaluasi Program',
            'Dukungan Pihak Lain',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => false,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ]
            ]
        ];
    }
}
