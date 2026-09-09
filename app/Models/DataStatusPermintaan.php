<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatusPermintaan extends Model
{
    use HasFactory;

    protected $table = 'datastatuspermintaan';

    protected $fillable = [
        'nama_mahasiswa',
        'universitas',
        'jurusan',
        'nik_sap',
        'nama_mentor',
        'unit_kerja',
        'status',
        'alasan_penolakan',
    ];
}
