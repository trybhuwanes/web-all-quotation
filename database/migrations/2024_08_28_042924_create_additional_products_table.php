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
        Schema::create('additional_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->uuid('uuid');
            $table->string('nama_produk_tambahan');
            $table->string('thumbnail_produk_tambahan')->nullable();
            $table->text('deskripsi_produk_tambahan')->nullable();
            $table->decimal('harga_produk_tambahan', 20, 2);
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_products');
    }
};
