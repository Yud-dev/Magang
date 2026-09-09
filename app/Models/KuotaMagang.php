<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuotaMagang extends Model
{
    use HasFactory;

    protected $table = 'kuota_magangs';

    protected $fillable = [
        'id',
        'UnitKerja',
        'tahun',
        'batch',
        'kuota',
    ];

     public function unitkerja()
     {
         return $this->belongsTo(Unitkerja::class);

}
}
