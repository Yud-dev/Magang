<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatatabelQR extends Model
{
    //
    protected $table = 'datatabel_qr';
    protected $fillable = [
        'id',
        'Nama_Barang',
        'Nama_rak',
        'posisi_rak',
        'foto',
        'tanggalscan',
        'outner',
        'PIC',
        'Jenis',
    ];
}
