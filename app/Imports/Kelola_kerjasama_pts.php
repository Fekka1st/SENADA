<?php

namespace App\Imports;

use App\Models\data_kerjasama_PT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Kelola_kerjasama_pts implements ToCollection,WithStartRow,WithHeadingRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $row) {
            data_kerjasama_PT::firstOrCreate(
                ['kode_pt' => $row['kode']],
                [
                    'nama_pt' => $row['nama']?:'-',
                    'jumlah_mou' => $row['mou'],
                    'jumlah_moa' => $row['moa'],
                    'jumlah_ia' => $row['ia'],
                    'status' => $row['status'] ?: '-',
                ]
            );
        }
    }
}
