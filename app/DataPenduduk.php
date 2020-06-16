<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    protected $table = 'data_penduduk';
    protected $fillable = [
        'id',
        'id_kk',
        'rt',
        'nama',
        'NIK',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',

    ];
}
