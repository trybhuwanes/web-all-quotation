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
        Schema::create('product_specification_fmp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->decimal('harga', 20, 2);
            $table->string('type_name');
            $table->integer('dry_solids_min');
            $table->integer('dry_solids_max');
            $table->integer('dimension_l');
            $table->integer('dimension_w');
            $table->integer('dimension_h');
            $table->integer('net_weight')->nullable();
            $table->decimal('power_kw', 5, 2);
            $table->decimal('opex_chemical_min', 5, 3);
            $table->decimal('opex_chemical_max', 5, 2);
            $table->decimal('opex_electrical_min', 5, 2);
            $table->decimal('opex_electrical_max', 5, 2);

            // Kebutuhan Quotation
            $table->string('quot_pd_flush_water')->nullable();
            $table->string('quot_sc_specification_length')->nullable();
            $table->string('quot_sc_quantity')->nullable();
            $table->string('quot_sc_motorpower')->nullable();
            $table->string('quot_fmt_dimension')->nullable();
            $table->string('quot_fmt_volume')->nullable();
            $table->string('quot_fmt_motorpower')->nullable();
            $table->string('quot_equipment_weight')->nullable();
            $table->string('quot_operating_weight')->nullable();
            $table->string('quot_work_time')->nullable();

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
        Schema::dropIfExists('product_specification_fmp');
    }
};
