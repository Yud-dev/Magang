<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Belumdiambil extends Model
{
    protected $table = 'belumdiambils'; // nama tabel yang ada di db

    protected $fillable = [
        'id',
        'nama_barang',
        'foto',
        'deskripsi',
        'nama_penemu_barang',
        'tanggal_ditemukan',
    ];

    public $timestamps = false; // karena tabel ini tidak punya kolom created_at & updated_at
}
