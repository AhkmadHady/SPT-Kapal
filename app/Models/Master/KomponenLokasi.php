<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenLokasi extends Model
{
    protected $table 	= 'lokasi';
    protected $fillable = ['nama_lokasi','keterangan'];
}
