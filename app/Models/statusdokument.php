<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statusdokument extends Model
{
    //
    protected $table = "statusdokuments";
    protected $fillable = [
        'nama',
        'keterangan'
    ];
}
