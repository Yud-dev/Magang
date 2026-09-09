<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelumdiambilsTable extends Migration
{
    public function up()
    {
        Schema::create('belumdiambils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('foto')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('nama_penemu_barang');
            $table->date('tanggal_ditemukan')->nullable();
            $table->timestamps(); // => akan membuat kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('belumdiambils');
    }
}
