<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenerimaanMagang extends Model
{
    use HasFactory;
    protected $table = 'permintaan_magang';
    protected $fillable = [
        // Detail Mahasiswa
        'nama_mahasiswa',
        'universitas',
        'jurusan',

        // Detail Mentor & Penempatan
        'nik_sap',
        'nama_mentor',
        'unit_kerja',

        // Status & Alasan
        'status',
        'alasan_penolakan',

        // File
        'file_excel',
    ];

    /**
     * Kolom yang harus di-cast ke tipe data tertentu.
     * (Opsional, tapi direkomendasikan jika ada kolom tanggal atau JSON)
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string', // Meskipun enum, bisa di-cast sebagai string
    ];
}
