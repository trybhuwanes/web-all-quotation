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
        Schema::create('product_specification_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('type_name'); // Model produk
            $table->decimal('harga', 20, 2);
            // Kolom untuk spesifikasi Power Aerator
            $table->decimal('hp', 10, 2)->nullable();
            $table->decimal('kw', 10, 2)->nullable();
            $table->decimal('sotr', 10, 2)->nullable(); // kg/h
            $table->integer('md')->nullable(); // m
            $table->integer('mz')->nullable(); // m
            $table->string('d')->nullable(); // Rentang seperti "2~3"
            $table->decimal('pr', 10, 2)->nullable(); // m3/min
            // Kolom untuk spesifikasi Dry Solids
            $table->decimal('dry_solids_min', 10, 2)->nullable();
            $table->decimal('dry_solids_max', 10, 2)->nullable();
            $table->integer('dimension_l')->nullable(); // mm
            $table->integer('dimension_w')->nullable(); // mm
            $table->integer('dimension_h')->nullable(); // mm
            $table->decimal('power', 10, 2)->nullable(); // kW
            $table->decimal('opex_chemical_min', 10, 2)->nullable();
            $table->decimal('opex_chemical_max', 10, 2)->nullable();
            $table->decimal('opex_electrical_min', 10, 2)->nullable();
            $table->decimal('opex_electrical_max', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specification_models');
    }
};
