<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanPemeliharaan extends Model
{
    protected $table 	= 'pelaksanaan_pemeliharaan';
    protected $fillable = ['tgl_pelaksanaan','id_pelaksana','catatan','id_skedul'];
}
