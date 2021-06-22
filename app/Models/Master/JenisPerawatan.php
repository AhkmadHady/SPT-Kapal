<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class JenisPerawatan extends Model
{
    protected $table 	= 'jenis_perawatan';
    protected $fillable = ['jenis_perawatan','keterangan','kategori'];
}
