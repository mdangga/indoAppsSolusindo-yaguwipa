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
        Schema::create('riwayat_donasi', function(Blueprint $table){
            $table->id();
            $table->foreignId('id_donatur')->constrained('donatur')->onDelete('cascade');
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->foreignId('id_jenis_donasi')->constrained('jenis_donasi')->onDelete('restrict');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_donasi');
            $table->timestamps();
        });

        Schema::create('jenis_donasi', function (Blueprint $table) {
            $table->id('id_jenis_donasi');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_donasi');
        Schema::dropIfExists('jenis_donasi');
    }
};
