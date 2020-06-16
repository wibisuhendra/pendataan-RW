<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kartu_keluarga';
    protected $fillable = [
       'no_kk',
       'nama_kepala_keluarga',
        'rt',
       'alamat',
       'no_kontak',
       'email_kontak',
       'kartu_keluarga_img',
       'approval',
       'token',
    ];
}
