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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT (AUTO_INCREMENT)
            $table->string('nama', 255); // VARCHAR(255) for nama
            $table->text('deskripsi'); // TEXT for deskripsi
            $table->string('harga', 255); // VARCHAR(255) for harga
            $table->integer('jumlah_stok'); // INT for jumlah_s
            $table->string('kategori', 255); // VARCHAR(255) for kategori
            $table->string('url_gambar', 255); // VARCHAR(255) for url_gambar
            $table->date('tanggal_ditambahkan'); // DATE for tanggal_ditambahkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
