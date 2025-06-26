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
        Schema::create('jenis_donasi', function (Blueprint $table) {
            $table->id('id_jenis_donasi');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
        
        Schema::create('riwayat_donasi', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_donatur');
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->unsignedBigInteger('id_jenis_donasi');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_donasi');
            $table->timestamps();
            
            $table->foreign('id_donatur')->references('id_donatur')->on('donatur')->onDelete('cascade');
            $table->foreign('id_jenis_donasi')->references('id_jenis_donasi')->on('jenis_donasi')->onDelete('restrict');
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
