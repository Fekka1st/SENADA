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
        return 2;
    }
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            try {
                if (empty($row['kode_pt'])) {
                    throw new \Exception('kode_pt cannot be empty');
                }
                direktori_PT::updateOrCreate(
                    ['kode_pt' => $row['kode_pt']],
                    [
                        'nama_pt' => $row['nama_perguruan_tinggi']?:'-',
                        'data_mou' => in_array($row['mou'], ['', null, '-']) ? 0 : $row['mou'],
                        'data_moa' => in_array($row['moa'], ['', null, '-']) ? 0 : $row['moa'],
                        'data_ia' => in_array($row['ia'], ['', null, '-']) ? 0 : $row['ia'],
                        'akreditasi' => $row['akreditasi']?:'-',
                        'alamat' => $row['alamat']?:'-',
                        'jenis_pt' => $row['jenis_pt']?:'-',
                        'domisili' => $row['domisili']?:'-',
                        'provinsi' => $row['provinsi']?:'-',
                        'status' => $row['status']?:'-'
                    ]
                );
            } catch (\Throwable $e) {
                Log::error('Error importing row:', [
                    'row' => $row->toArray(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
