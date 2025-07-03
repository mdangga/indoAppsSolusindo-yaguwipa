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
        Schema::create('kategori_kerja_sama', function(Blueprint $table){
            $table->id('id_kategori_kerja_sama');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
        
        Schema::create('kerja_sama', function(Blueprint $table){
            $table->id();
            $table->text('keterangan')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_kategori_kerja_sama');
            $table->timestamps();

            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade');
            $table->foreign('id_kategori_kerja_sama')->references('id_kategori_kerja_sama')->on('kategori_kerja_sama')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kerja_sama');
        Schema::dropIfExists('kerja_sama');
    }
};