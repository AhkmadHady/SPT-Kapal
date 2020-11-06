<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class Skedul extends Model
{
    protected $table 	= 'skedul';
    protected $fillable = ['kode_pemeliharaan','tgl_skedul','tahun','status'];
}
