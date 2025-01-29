<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direktori_PT extends Model
{
    //
    protected $table = "data_direktori_pt";
    protected $fillable = [
        'kode_pt',
        'nama_pt',
        'data_mou',
        'data_moa',
        'data_ia',
        'akreditasi',
        'alamat',
        'jenis_pt',
        'domisili',
        'provinsi',
        'status'
    ];

    
    public function kerjasama()
    {
        return $this->hasMany(data_kerjasama_PT::class, 'kode_pt', 'kode_pt');
    }
}
