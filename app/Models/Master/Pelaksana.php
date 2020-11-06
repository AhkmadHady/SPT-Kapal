<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    protected $table 	= 'pelaksana';
    protected $fillable = ['nama_pelaksana','keterangan'];
}
