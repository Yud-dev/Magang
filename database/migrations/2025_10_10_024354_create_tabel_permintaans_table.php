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
        Schema::create('tabel_permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('NIK_SAP');
            $table->string('Nama_Mentor');
            $table->string('NO_WA_Mentor');
            $table->string('Batch');
            $table->string('UnitKerja');
            $table->string('Bagian');
            $table->string('Jurusan');
            $table->string('JudulPA');
            $table->integer('tahunmagang');

            // FILE EXCEL
            $table->string('file_excel')->nullable();

            // STATUS DISINI
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_permintaans');
    }
};
