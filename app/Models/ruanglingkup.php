<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ruanglingkup extends Model
{
    //
    protected $table = 'ruanglingkup';
    protected $fillable = [
        'nama_ruanglingkup',
        'keterangan'
    ];

    public function ruanglingkup()
    {
        return $this->hasMany(kermapemdaruanglingkup::class,'pemda_id','id');
    }
}
