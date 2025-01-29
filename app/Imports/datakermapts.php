<?php

namespace App\Imports;

use App\Models\datakerma_pemda;
use App\Models\kermapemdapts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class datakermapts implements ToCollection,WithStartRow,WithHeadingRow
{
    public $failedRows = [];
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
                if (empty($row['nama_mitra'])) {
                    throw new \Exception("Nama Mitra tidak boleh kosong di baris " . ($row + 2));
                }
                $pemda = datakerma_pemda::where('nama_pemda', $row['nama_mitra'])->first();
                if (!$pemda) {
                    $failedRows[] = [
                        'row' => $row,
                        'error' => 'Nama Mitra not found in datakermapemda table',
                    ];
                    continue;
                }
                kermapemdapts::create([
                    'pemda_id'       => $pemda->id,
                    'nama_pt'        => $row['nama_perguruan_tinggi'] ?: '-',
                    'tahun_kerjasama' => $row['tahun_kerja_sama'] ?: '-',
                    'jangka_waktu'   => $row['jangka_waktu'] ?: '-',
                ]);
            } catch (\Throwable $e) {
                //throw $th;
                $this->failedRows[] = $e->getMessage();
            }
        }
        if (!empty($this->failedRows)) {
            throw new \Exception(implode("\n", $this->failedRows));
        }
        //
    }
}
