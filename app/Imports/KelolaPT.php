<?php

namespace App\Imports;

use App\Models\direktori_PT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
            try {
                // Validasi kode_pt wajib ada
                if (empty($row['1'])) {
                    throw new \Exception('kode_pt cannot be empty');
                }

                direktori_PT::updateOrCreate(
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
            } catch (\Throwable $e) {
                // Log error dan baris yang gagal
                Log::error('Error importing row:', [
                    'row' => $row->toArray(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
