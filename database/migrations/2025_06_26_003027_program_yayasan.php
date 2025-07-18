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
        Schema::create('kategori_program', function (Blueprint $table) {
            $table->id('id_kategori_program');
            $table->string('nama')->unique();
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('program', function (Blueprint $table) {
            $table->id('id_program');
            $table->string('nama');
            $table->string('image_path')->nullable();
            $table->longText('deskripsi');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->unsignedBigInteger('id_kategori_program');
            $table->timestamps();

            $table->foreign('id_kategori_program')->references('id_kategori_program')->on('kategori_program')->onDelete('cascade');
        });

        Schema::create('institusi_terlibat', function (Blueprint $table) {
            $table->id('id_institusi');
            $table->string('nama');
            $table->string('alamat');
            $table->string('website')->nullable();
            $table->timestamps();
        });

        Schema::create('program_institusi', function (Blueprint $table) {
            $table->id('id_program_institusi');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_institusi');
            $table->timestamps();

            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('cascade');
            $table->foreign('id_institusi')->references('id_institusi')->on('institusi_terlibat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_program');
        Schema::dropIfExists('program');
        Schema::dropIfExists('institusi_terlibat');
        Schema::dropIfExists('program_institusi');
    }
};
