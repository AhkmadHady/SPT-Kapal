<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table 	= 'periode';
    protected $fillable = ['periode','rumus','keterangan'];
}
