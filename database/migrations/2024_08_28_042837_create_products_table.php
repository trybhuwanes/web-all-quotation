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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->uuid('uuid')->unique();
            $table->string('nama_produk')->unique();
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi_produk')->nullable();
            $table->longText('ringkasan_deskripsi')->nullable();
            $table->longText('spesifikasi_deskripsi')->nullable();
            // $table->decimal('harga', 20, 2);
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->string('specification_type')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category_products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
