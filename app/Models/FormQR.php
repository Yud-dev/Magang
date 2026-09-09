<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormQR extends Model
{
    //
    protected $table = 'Form_QR';
    protected $fillable = [
        'id',
        'Nama_Barang',
      'Nama_rak',
        'posisi_rak',
        'foto',
        'tanggalscan',
        'outner',
        'PIC',
    ]; // nama tabel yang ada di db
}
