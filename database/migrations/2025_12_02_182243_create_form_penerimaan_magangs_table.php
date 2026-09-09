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
       Schema::create('permintaan_magang', function (Blueprint $table) {
            $table->id();

            // Kolom Detail Mahasiswa
            $table->string('nama_mahasiswa', 150);
            $table->string('universitas', 150);
            $table->string('jurusan', 100);

            // Kolom Detail Mentor & Penempatan
            $table->string('nik_sap', 50);
            $table->string('nama_mentor', 150);
            $table->string('unit_kerja', 100);

            // Kolom Status (untuk persetujuan)
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('alasan_penolakan')->nullable(); // Untuk menyimpan alasan jika status = ditolak

            // Kolom Tambahan (Opsional, tergantung kebutuhan Anda)
            // Misalnya: file_excel dari kode awal
            $table->string('file_excel')->nullable();

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_penerimaan_magangs');
    }
};
