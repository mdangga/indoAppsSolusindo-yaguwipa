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
        Schema::create('kanal_donasi', function (Blueprint $table) {
            $table->id('id_kanal_donasi');
            $table->string('nama')->unique();
            $table->timestamps();
        });
        
        Schema::create('donasi', function(Blueprint $table){
            $table->id();
            $table->text('nama');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('total_dana', 15, 2)->nullable();
            $table->unsignedBigInteger('id_program')->nullable();
            $table->timestamps();
            
            $table->foreign('id_program')->references('id_program')->on('program')->onDelete('cascade');
        });
        
        Schema::create('donasi_donatur', function(Blueprint $table){
            $table->id();
            $table->decimal('jumlah_donasi', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('id_donatur')->nullable();
            $table->unsignedBigInteger('id_kanal_donasi');
            $table->unsignedBigInteger('id_donasi');
            
            $table->foreign('id_donatur')->references('id_donatur')->on('donatur')->onDelete('cascade');
            $table->foreign('id_kanal_donasi')->references('id_kanal_donasi')->on('kanal_donasi')->onDelete('restrict');
            $table->foreign('id_donasi')->references('id_donasi')->on('donasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_donasi');
        Schema::dropIfExists('riwayat_donasi');
    }
};
