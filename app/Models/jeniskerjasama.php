<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jeniskerjasama extends Model
{
    //
    protected $table = "jeniskerjasamas";
    protected $fillable = [
        'nama',
        'keterangan'
    ];
}
