<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sudahdiambil extends Model
{
    //
    protected $table = 'sudahdiambils';

    protected $fillable = [
    'nama_barang',
    'PIC',
    'foto',
     'tanggal_ditemukan',
    'lokasi_ditemukan',


    ];
     public $timestamps = false;
}
