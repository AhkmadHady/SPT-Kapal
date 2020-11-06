<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenPokok extends Model
{
    protected $table 	= 'komponen_pokok';
    protected $fillable = ['kode_pokok','nama_pokok','keterangan'];


    // public function subpokok(){
    // 	return $this->hasMany(KomponenSubPokok::class,'id_komponen_pokok');
    // } 
}
