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
        Schema::create('Form_QR', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
  $table->string('Jenis');

              $table->string('posisi_rak');
               $table->string('foto');
                $table->string('tanggalscan');
                 $table->string('outner');
                  $table->string('PIC');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_q_r_s');
    }
};
