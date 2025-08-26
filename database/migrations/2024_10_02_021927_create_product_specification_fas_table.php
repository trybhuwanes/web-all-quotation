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
        Schema::create('product_specification_fas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->decimal('harga', 20, 2);
            $table->string('type_name');
            // $table->longText('description_specification');
            $table->decimal('power_hp', 8, 1);
            $table->decimal('power_kw', 8, 1);
            $table->decimal('aerator_sotr', 8, 1);
            $table->decimal('aerator_md', 8, 1);
            $table->integer('aerator_mz');
            $table->string('aerator_d');
            $table->integer('aerator_pr');
            $table->integer('net_weight')->nullable();

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
        Schema::dropIfExists('product_specification_fas');
    }
};
