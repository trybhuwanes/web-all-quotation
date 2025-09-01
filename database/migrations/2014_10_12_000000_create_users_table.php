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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->enum('status', ['nonactive', 'pending', 'active'])->default('pending');
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('location_company')->nullable();
            $table->string('field_company')->nullable();
            $table->string('detail_company')->nullable();
            $table->string('photo')->nullable();
            $table->enum('role', ['admin', 'pic', 'customer'])->default('customer');

            // Kebutuhan Shipping
            $table->string('state')->nullable(); //provinsi 
            $table->string('country')->nullable(); //kabupaten/kota 
            $table->string('district')->nullable(); //kecamatan
            $table->string('address_detail')->nullable(); //Alamat Lengkap

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
