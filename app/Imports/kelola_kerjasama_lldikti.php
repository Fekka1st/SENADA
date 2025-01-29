<?php

namespace App\Imports;

use App\Models\datamou;
use App\Models\jeniskerjasama;
use App\Models\jenismitra;
use App\Models\statusdokument;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class kelola_kerjasama_lldikti implements ToCollection,WithStartRow,WithHeadingRow
{

    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection){
        $failedRows = [];
        foreach ($collection as $row) {
            try {
                $nomorAgendaMitra = $row['nomor_agenda_mitra'] ?? '-';
                $nomorAgendaLldikti = $row['nomor_agenda_lldikti'] ?? '-';
                $namaMitra = $row['nama_mitra'] ?? '-';
                $perihal = $row['perihal'] ?? '-';

                $jenisMitraText = strtoupper($row['jenis_mitra'] ?? '-');
                $jenisKerjasamaText = strtoupper($row['jenis_kerjasama'] ?? '-');
                $statusText = strtoupper($row['status_dokumen'] ?? '-');

                $jenisMitra = jenismitra::firstOrCreate(
                    ['nama' => $jenisMitraText],
                    ['keterangan' => 'Data otomatis dibuat dari import']
                );

                $jenisKerjasama = jeniskerjasama::firstOrCreate(
                    ['nama' => $jenisKerjasamaText],
                    ['keterangan' => 'Data otomatis dibuat dari import']
                );

                $statusDokumen = statusdokument::firstOrCreate(
                    ['nama' => $statusText],
                    ['keterangan' => 'Data otomatis dibuat dari import']
                );

                $existingData = datamou::where('nomor_agenda_mitra', $nomorAgendaMitra)
                ->where('nomor_agenda_lldikti', $nomorAgendaLldikti)
                ->where('nama_mitra', $namaMitra)
                ->first();

                if ($existingData) {
                    // dd($row['bentuk_tindak_lanjut'] ?? '-');
                    // datamou::firstOrCreate(
                    //     [
                    //         'nomor_agenda_mitra' => $row['nomor_agenda_mitra'],
                    //         'nomor_agenda_lldikti' => $row['nomor_agenda_lldikti'],
                    //         'nama_mitra' => $row['nama_mitra'],
                    //         'perihal' => $row['perihal'],
                    //     ],
                    //     [
                    //         'tahun' => $row['tahun'] ?? '-',
                    //         'jenis_mitra' => $jenisMitra->id ?? 0,
                    //         'jenis_kerjasama' => $jenisKerjasama->id ?? 0,
                    //         'status' => $statusDokumen->id ?? 0,
                    //         'masa_berlaku' => $row['masa_berlaku_mou'] ?? 0,
                    //         'mulai_berlaku' => $row['mulai_berlaku'],
                    //         'kadaluarsa' => $row['kadaluwarsa'],
                    //         'keterangan_dokumen' => $row['keterangan_dokumen']?? '-',
                    //         'jenis_file' => 'google_drive',
                    //         'file' => $row['file'],
                    //         'bentuk_tindak_lanjut' => $row['bentuk_tindak_lanjut'] ?? '-',
                    //     ]
                    // );
                     // Update existing record if necessary
                $existingData->update([
                    'tahun' => $row['tahun'] ?? '-',
                    'jenis_mitra' => $jenisMitra->id ?? null,
                    'jenis_kerjasama' => $jenisKerjasama->id ?? null,
                    'status' => $statusDokumen->id ?? null,
                    'masa_berlaku' => $row['masa_berlaku_mou'] ?? null,
                    'mulai_berlaku' => $row['mulai_berlaku'],
                    'kadaluarsa' => $row['kadaluwarsa'],
                    'keterangan_dokumen' => $row['keterangan_dokumen'] ?? '-',
                    'jenis_file' => 'google_drive',
                    'file' => $row['file'],
                    'bentuk_tindak_lanjut' => $row['bentuk_tindak_lanjut'] ?? '-',
                ]);
                }else{
                    datamou::create([
                        'nomor_agenda_mitra' => $row['nomor_agenda_mitra'],
                        'nomor_agenda_lldikti' => $row['nomor_agenda_lldikti'],
                        'nama_mitra' => $row['nama_mitra'],
                        'perihal' => $row['perihal'],
                        'tahun' => $row['tahun'] ?? '-',
                        'jenis_mitra' => $jenisMitra->id ?? 0,
                        'jenis_kerjasama' => $jenisKerjasama->id ?? 0,
                        'status' => $statusDokumen->id ?? 0,
                        'masa_berlaku' => $row['masa_berlaku_mou'] ?? 0,
                        'mulai_berlaku' => $row['mulai_berlaku'],
                        'kadaluarsa' => $row['kadaluwarsa'],
                        'keterangan_dokumen' => $row['keterangan_dokumen'] ?? '-',
                        'jenis_file' => 'google_drive',
                        'file' => $row['file'],
                        'bentuk_tindak_lanjut' => $row['bentuk_tindak_lanjut'] ?? '-',
                    ]);
                }
            } catch (\Throwable $e) {
                $failedRows[] = [
                    'row' => $row->toArray(),
                    'error' => $e->getMessage(),
                ];
            }
        }
        if (!empty($failedRows)) {
            $this->reportFailedRows($failedRows);
        }
    }

    protected function reportFailedRows(array $failedRows)
    {
        foreach ($failedRows as $failedRow) {
            Log::error('Failed to import row', [
                'data' => $failedRow['row'],
                'error' => $failedRow['error'],
            ]);
        }
    }
}
