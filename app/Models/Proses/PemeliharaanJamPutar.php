<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class PemeliharaanJamPutar extends Model
{
    protected $table 	= 'service_putaran';
    protected $fillable = ['tgl_pemeliharaan','id_kartu_pemeliharaan','jml_putaran','id_pelaksana','catatan'];
}
