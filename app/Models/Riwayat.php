<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayats';

    protected $fillable = [

        'nama_pengambil',
        'no_whatsapp',
        'nama_barang',
        'tanggal',
        'jam',
         'foto',
    ];

 
}
