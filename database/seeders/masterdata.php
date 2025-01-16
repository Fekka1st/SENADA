<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterdata extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jenisMitra = [
            'PTN',
            'PTS',
            'PTLN',
            'PEMERINTAH',
            'LEMBAGA PEMERINTAH NON PEMDA',
            'DUDI',
            'BANK',
            'ORGANISASI NIRLABA'
        ];

        foreach ($jenisMitra as $mitra) {
            DB::table('jenismitras')->insert([
                'nama' => $mitra,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $jenisKerjasama = [
            'NOTA KESEPAHAMAN',
            'MOU KERJASAMA',
            'MOU KESEPAKATAN',
            'ADENDUM PERJANJIAN',
            'KONSORSIUM',
            'MOU KESEPAKATAN TERPADU',
            'IMPLEMENTATION AGREEMENT'
        ];

        foreach ($jenisKerjasama as $kerjasama) {
            DB::table('jeniskerjasamas')->insert([
                'nama' => $kerjasama,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $statusdokument = [
            'LENGKAP',
            'TIDAK LENGKAP'
        ];
        foreach ($statusdokument as $dokument) {
            DB::table('statusdokuments')->insert([
                'nama' => $dokument,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
