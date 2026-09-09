<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelPermintaan extends Model
{
    protected $table = 'tabel_permintaans';

    protected $fillable = [
        'NIK_SAP',
        'Nama_Mentor',
        'NO_WA_Mentor',
        'Batch',
        'UnitKerja',
        'Bagian',
        'Jurusan',
        'JudulPA',
        'tahunmagang',
        'file_excel',   // pengganti CekData
        'status',
    ];
}
