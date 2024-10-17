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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key auto-increment
            $table->string('nama', 100); // Nama pelanggan
            $table->string('alamat', 255); // Alamat
            $table->string('no_telepon', 20); // Nomor telepon
            $table->integer('total_pembayaran'); // Jumlah pembayaran
            $table->string('metode_pembayaran', 20); // Metode pembayaran
            $table->timestamp('waktu_pemesanan')->useCurrent(); // Waktu pemesanan
            $table->string('status', 20)->default('pending'); // Status pesanan
            $table->string('bukti_transfer', 255)->nullable(); // Bukti transfer (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
