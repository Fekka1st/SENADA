<?php

namespace App\Exports;

use App\Models\kermapemdapts;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class datapemdaPTS implements FromCollection,WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return kermapemdapts::with(['pemda'])->get()->map(function ($item,$index) {
            return [
                'No' => $index + 1,
                'Nama Mitra' => $item->pemda->nama_pemda ?? '-',
                'Nama Perguruan Tinggi' => $item->nama_pt?? '-',
                'Tahun Kerja Sama' => $item->tahun_kerjasama??'-',
                'Jangka Waktu' => $item->jangka_waktu??'-',
            ];
        });
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Mitra',
            'Nama Perguruan Tinggi',
            'Tahun Kerja Sama',
            'Jangka Waktu',
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
