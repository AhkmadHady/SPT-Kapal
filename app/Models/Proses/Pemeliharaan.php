<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    protected $table 	= 'kartu_pemeliharaan';
    protected $fillable = ['tanggal','kode_pemeliharaan','id_komponen_pokok','id_komponen_sub_pokok','id_sistem','id_sub_sistem','id_pelaksana','id_lokasi','uraian_pemeliharaan','tindakan_pengamanan','prosedur','user_create','id_komponen','alat_kerja','jo','id_periode','tgl_muali'];
}
