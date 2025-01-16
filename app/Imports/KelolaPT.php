<?php

namespace App\Imports;

use App\Models\direktori_PT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KelolaPT implements ToCollection,WithStartRow,WithHeadingRow{

    public function startRow(): int
    {
        return 3;
    }
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            direktori_PT::firstOrCreate(
                ['kode_pt' => $row[1]],
                [
                    'nama_pt' => $row[2]?:'-',
                    'akreditasi' => $row[3]?:'-',
                    'alamat' => $row[4]?:'-',
                    'jenis_pt' => $row[5]?:'-',
                    'domisili' => $row[7]?:'-',
                    'provinsi' => $row[8]?:'-',
                ]
            );
        }
    }
}
