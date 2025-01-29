<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kontakpemda extends Model
{
    //

    protected $table = 'kontak_pemda';
    protected $fillable = [
        'nama',
        'jabatan',
        'no_hp',
        'email',
        'alamat',
        'pemda_id'
    ];

    public function pemda()
    {
        return $this->belongsTo(datakerma_pemda::class,'pemda_id','id');
    }
}
