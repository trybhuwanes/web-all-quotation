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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('trx_code')->unique()->nullable();
            $table->unsignedBigInteger('user_id'); // ID customer
            $table->unsignedBigInteger('pic_id')->nullable(); // ID PIC
            $table->decimal('subtotal', 20, 2); // subtotal produk utama dan tambahan
            $table->decimal('total_price', 20, 2); // grand total setelah perhitungan diskon dan pengiriman
            $table->decimal('discount_amount', 20, 2)->default(0); // Nilai diskon
            $table->enum('discount_type', ['percentage', 'fixed'])->default('fixed'); // Jenis diskon (persentase atau nominal)
            $table->enum('status', ['cancelled', 'pending', 'submission', 'processing', 'completed'])->default('pending');
            $table->string('po_path')->nullable(); // Menyimpan path file PO PDF
            $table->string('attachment_path')->nullable(); // Menyimpan path file attachment
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('pic_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
