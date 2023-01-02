<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KomponenMaster extends Model
{
    protected $table 	= 'komponen_master';
    protected $fillable = ['kdkomponen','nmkomponen','keterangan'];
}
