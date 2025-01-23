<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_kerjasama_PT extends Model
{
    //
    protected $table = "data_kerjasama_pts";
    protected $fillable = [
        'kode_pt',
        'nama_pt',
        'jumlah_mou',
        'jumlah_moa',
        'jumlah_ia',
        'status'
    ];
    public function direktori()
    {
        return $this->belongsTo(direktori_PT::class, 'kode_pt', 'kode_pt');
    }
}
