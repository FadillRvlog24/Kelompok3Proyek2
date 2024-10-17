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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id'); // Primary key
            $table->bigInteger('user_id')->unsigned(); // Foreign key ke users
            $table->string('name', 255); // Nama pelanggan
            $table->date('tanggal_order'); // Tanggal pemesanan
            $table->string('no_telepon', 20); // Nomor telepon
            $table->string('alamat', 50); // Alamat
            $table->string('metode_pembayaran', 50); // Metode pembayaran
            $table->integer('jumlah_pembayaran'); // Jumlah pembayaran
            $table->integer('total'); // Total harga
            $table->string('status', 50)->default('pending'); // Status pesanan
            $table->text('catatan')->nullable(); // Catatan opsional
            $table->string('bukti_pembayaran', 255)->nullable(); 
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
