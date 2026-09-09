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
        //
        Schema::create('sudahdiambils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
              $table->string('PIC');
              $table->string('foto')->nullable();
 $table->date('tanggal_ditemukan');
            $table->string('lokasi_ditemukan');



           // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
             Schema::dropIfExists('sudahdiambils');
    }
};
