<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kermapemdaruanglingkup extends Model
{
    //
    protected $table = 'datakerma_pemda_ruanglingkup';
    protected $fillable = [
        'pemda_id',
        'ruang_lingkup_id',
        'nama_program',
        'tgl_pelaksanaan_start',
        'tgl_pelaksanaan_end',
        'kpi_program',
        'pencapaian_program',
        'evaluasi_program',
        'dukungan_pihak_lain'
    ];

    public function pemda()
    {
        return $this->belongsTo(datakerma_pemda::class,'pemda_id','id');
    }

    public function ruanglingkup()
    {
        return $this->belongsTo(ruanglingkup::class,'ruang_lingkup_id','id');
    }
}
