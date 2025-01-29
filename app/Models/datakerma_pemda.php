<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datakerma_pemda extends Model
{
    //
    protected $table = 'data_kerma_pemdas';
    protected $fillable = [
        'nama_pemda',
        'provinsi',
        'status',
        'join_grup'
    ];

    public function kontakpemda(){
        return $this->hasMany(kontakpemda::class,'pemda_id','id');
    }
    public function kermapemdaruanglingkup(){
        return $this->hasMany(kermapemdaruanglingkup::class,'pemda_id','id');
    }
    public function kermapemdapts(){
        return $this->hasMany(kermapemdapts::class,'pemda_id','id');
    }

}
