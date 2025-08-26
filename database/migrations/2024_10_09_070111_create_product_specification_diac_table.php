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
        Schema::create('product_specification_diac', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Relasi ke tabel products
            $table->decimal('harga', 20, 2);
            $table->string('type_name'); // Tipe produk (e.g., BF-005)
            // $table->longText('description_specification');
            $table->decimal('capacity', 8, 1)->nullable(); // Kapasitas produk

            // Kebutuhan Shipping
            $table->decimal('floater_kubikasi', 5, 3)->nullable();
            $table->decimal('motor_kubikasi', 5, 3)->nullable();
            $table->decimal('floater_kg', 5, 2)->nullable();
            $table->decimal('motor_kg', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specification_diac');
    }
};
