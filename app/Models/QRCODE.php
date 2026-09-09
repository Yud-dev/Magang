<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCODE extends Model
{
    use HasFactory;

    protected $table = 'qrcode_rak'; // nama tabel sesuai migrasi
   public $timestamps = false;
    protected $fillable = [
        'id',
        'Nama_rak',
        'posisi_rak',


    ];


}
