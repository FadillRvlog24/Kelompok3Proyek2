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
        Schema::create('cart', function (Blueprint $table) {
            $table->id(); // Auto-incremented ID
            $table->string('product_name', 255); // VARCHAR(255) for product name
            $table->string('price', 255); // VARCHAR(255) for price
            $table->integer('quantity'); // INT for quantity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
