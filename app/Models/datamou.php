<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datamou extends Model
{
    //

    protected $table = 'data_mous';
    protected $fillable = [
        'nama_mitra',
        'perihal',
        'tahun',
        'jenis_mitra',
        'jenis_kerjasama',
        'masa_berlaku',
        'mulai_berlaku',
        'kadaluarsa',
        'nomor_agenda_mitra',
        'nomor_agenda_lldikti',
        'status',
        'keterangan_dokumen',
        'jenis_file',
        'file',
        'bentuk_tindak_lanjut'
    ];

    public function jenisMitra()
    {
        return $this->belongsTo(jenismitra::class, 'jenis_mitra');
    }

    public function jenisKerjasama()
    {
        return $this->belongsTo(jeniskerjasama::class, 'jenis_kerjasama');
    }

    public function statusDokumen()
    {
        return $this->belongsTo(statusdokument::class, 'status');
    }
}
