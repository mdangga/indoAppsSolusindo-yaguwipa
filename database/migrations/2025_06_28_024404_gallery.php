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
        Schema::create('gallery', function (Blueprint $table) {
            $table->id('id_gallery');
            $table->string('alt_text');
            $table->string('link');
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->enum('kategori', ['foto', 'video']);
            $table->unsignedBigInteger('id_program')->nullable();
            $table->timestamps();

            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
