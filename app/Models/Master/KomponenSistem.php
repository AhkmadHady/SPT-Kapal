<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenSistem extends Model
{
    protected $table 	= 'komponen_sistem';
    protected $fillable = ['kode_komponen_sistem','nama_komponen_sistem','keterangan'];
}
