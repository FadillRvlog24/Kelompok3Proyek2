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
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('order_id'); // Primary key with auto-increment
            $table->bigInteger('user_id')->unsigned(); // Foreign key to the users table
            $table->string('name', 255); // Customer's name
            $table->date('tanggal_order'); // Order date
            $table->string('no_telepon', 20); // Phone number
            $table->string('alamat', 50); // Address
            $table->string('metode_pembayaran', 50); // Payment method (Bank Transfer, E-Wallet, COD)
            $table->integer('jumlah_pembayaran'); // Payment amount
            $table->string('status', 50)->default('pending'); // Status (Pending, Completed, etc.)
            $table->integer('total'); // Total price
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
