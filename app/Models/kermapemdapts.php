<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kermapemdapts extends Model
{
    //
    protected $table = 'datakerma_pemda_pts';
    protected $fillable = [
        'pemda_id',
        'tahun_kerjasama',
        'nama_pt',
        'jangka_waktu'
    ];

    public function pemda()
    {
        return $this->belongsTo(datakerma_pemda::class,'pemda_id','id');
    }



}
