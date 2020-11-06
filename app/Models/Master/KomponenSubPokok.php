<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenSubPokok extends Model
{
    protected $table 	= 'komponen_sub_pokok';
    protected $fillable = ['kode_sub_pokok','nama_sub_pokok','keterangan'];

    // public function pokok(){
    // 	return $this->belongsTo(KomponenPokok::class,'id');
    // }
     
    
}
