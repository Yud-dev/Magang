<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPengambilan extends Model
{
    //
    protected $table = 'form_pengambilans';

    protected $fillable = [
        'nama_pengambil',
        'no_whatsapp',
        'nama_barang',
        'tanggal',
        'jam',
         'foto',
    ];
    

}
