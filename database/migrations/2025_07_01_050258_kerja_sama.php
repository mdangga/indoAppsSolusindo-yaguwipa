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
            $table->timestamps();
        });
        
        
        Schema::create('kerja_sama', function(Blueprint $table){
            $table->id('id_kerja_sama');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('alasan')->nullable();
            $table->enum('status', ['approved', 'pending', 'rejected', 'expired'])->default('pending');
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_kategori_kerja_sama');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id_mitra')->on('mitra');
            $table->foreign('id_kategori_kerja_sama')->references('id_kategori_kerja_sama')->on('kategori_kerja_sama')->onDelete('cascade');
        });
        
        Schema::create('file_penunjang', function(Blueprint $table){
            $table->id('id_file_penunjang');
            $table->string('file_path');
            $table->string('nama_file');
            $table->integer('file_size');
            $table->unsignedBigInteger('id_kerja_sama');
            $table->timestamps();
    
            $table->foreign('id_kerja_sama')->references('id_kerja_sama')->on('kerja_sama');
        });
    }
    
    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('file_penunjang');
        Schema::dropIfExists('kerja_sama');
        Schema::dropIfExists('kategori_kerja_sama');
    }
};