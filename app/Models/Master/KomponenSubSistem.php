<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenSubSistem extends Model
{
     protected $table 	= 'komponen_sub_sistem';
    protected $fillable = ['kode_komponen_sub_sistem','nama_komponen_sub_sistem','keterangan'];
}
