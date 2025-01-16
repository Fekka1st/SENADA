<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jenismitra extends Model
{
    //
    protected $table = "jenismitras";
    protected $fillable = [
        'nama',
        'keterangan'
    ];
}
