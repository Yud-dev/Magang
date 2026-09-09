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
        Schema::create('kuota_magangs', function (Blueprint $table) {
    $table->id();

    $table->string('UnitKerja');
    $table->integer('tahun');
    $table->string('batch');
    $table->integer('kuota');
    $table->timestamps();
       $table->unique(['UnitKerja', 'tahun', 'batch']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuota_magangs');
    }
};
