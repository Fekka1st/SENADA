<?php

namespace App\Imports;

use App\Models\data_kerjasama_PT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
            try {
                // Validasi kode_pt wajib ada
                if (empty($row['kode'])) {
                    throw new \Exception('kode_pt cannot be empty');
                }

                data_kerjasama_PT::updateOrCreate(
                    ['kode_pt' => $row['kode']],
                    [
                        'nama_pt' => $row['nama'] ?: '-',
                        'jumlah_mou' => is_numeric($row['mou']) ? $row['mou'] : 0,
                        'jumlah_moa' => is_numeric($row['moa']) ? $row['moa'] : 0,
                        'jumlah_ia' => is_numeric($row['ia']) ? $row['ia'] : 0,
                        'status' => $row['status'] ?: '-',
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
