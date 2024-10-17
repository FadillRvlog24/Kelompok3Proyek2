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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran'); // BIGINT (AUTO_INCREMENT)
            $table->string('nama', 255); // VARCHAR(255) for nama
            $table->string('alamat', 255); // VARCHAR(255) for alamat
            $table->string('no_telepon', 50); // VARCHAR(50) for no_telepon
            $table->string('metode_pembayaran', 50); // VARCHAR(50) for metode_pembayaran
            $table->integer('jumlah_pembayaran'); // INT for jumlah_pembayaran
            $table->timestamp('waktu_pemesanan')->default(DB::raw('CURRENT_TIMESTAMP')); // TIMESTAMP with default CURRENT_TIMESTAMP
            $table->string('status', 20); // VARCHAR(20) for status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
