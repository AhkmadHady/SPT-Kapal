<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class VerifikasiSkedul extends Model
{
    protected $table 	= 'verifikasi_skedul';
    protected $fillable = ['tgl_verifikasi','id_skedul','catatan_pelaksanaan','user_create'];
}
