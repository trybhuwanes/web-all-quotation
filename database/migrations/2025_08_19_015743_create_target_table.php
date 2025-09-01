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
        Schema::create('target', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pic_id');
            $table->unsignedTinyInteger('month'); // 1-12
            $table->year('year');                 // tahun target
            $table->bigInteger('target');         // nilai target
            $table->timestamps();

            $table->unique(['pic_id', 'month', 'year']);
            $table->foreign('pic_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target');
    }
};
