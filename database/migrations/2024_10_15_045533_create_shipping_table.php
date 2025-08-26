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
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->boolean('use_shipping_to_onsite')->default(false);
            $table->string('type_transportation')->nullable();
            $table->decimal('weight_kg')->nullable();
            $table->decimal('volume_m3')->nullable();
            $table->decimal('shipping_cost', 20, 2)->nullable();
            $table->string('state_destination')->nullable(); //provinsi 
            $table->string('country_destination')->nullable(); //kabupaten/kota 
            $table->string('district_destination')->nullable(); //kecamatan
            $table->string('address_destination')->nullable(); //Alamat Lengkap Tujuan

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
