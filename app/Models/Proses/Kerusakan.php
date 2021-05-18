<?php

namespace App\Models\Proses;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $table 	= 'kerusakan';
    protected $fillable = ['tgl_kerusakan','komponen','id_pelaksana','detail_kerusakan'];
} 
