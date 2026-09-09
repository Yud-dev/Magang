<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitkerja extends Model
{
    use HasFactory;

    protected $table = 'unitkerjas';

    protected $fillable = [
        'id',
        'ID_UnitKerja',
        'Nama_Mentor',
        'UnitKerja',
    ];

    public function kuotamagang()
    {
        return $this->hasMany(KuotaMagang::class, );
    }
}

