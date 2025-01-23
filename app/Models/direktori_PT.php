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
        'akreditasi',
        'alamat',
        'jenis_pt',
        'domisili',
        'provinsi'
    ];
    public function kerjasama()
    {
        return $this->hasMany(data_kerjasama_PT::class, 'kode_pt', 'kode_pt');
    }
}
