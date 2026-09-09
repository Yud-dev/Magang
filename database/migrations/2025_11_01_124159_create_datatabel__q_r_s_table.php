<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datatabel_qr', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
             $table->string('Nama_rak');
              $table->string('posisi_rak');
               $table->string('foto');
                $table->string('tanggalscan');
                 $table->string('outner');
                  $table->string('PIC');
                     $table->string('Jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datatabel__q_r_s');
    }
};
