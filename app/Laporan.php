<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $fillable = [
        'no_kk',
        'id_kk',
        'rt',
        'judul',
        'subjek',
        'deskripsi',
    ];
}
