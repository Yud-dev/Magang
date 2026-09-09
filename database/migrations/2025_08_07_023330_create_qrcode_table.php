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
        Schema::create('qrcode_rak', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_rak')->nullable();                 // nama barang / berkas
            $table->string('posisi_rak');            // posisi rak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qrcode_rak');
    }
};
