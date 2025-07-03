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
        Schema::create('jenis_publikasi', function (Blueprint $table) {
            $table->id('id_jenis_publikasi');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
        Schema::create('publikasi', function (Blueprint $table) {
            $table->id('id_publikasi');
            $table->string('judul');
            $table->string('slug');
            $table->longText('deskripsi');
            $table->string('file');
            $table->dateTime('tanggal_terbit')->nullable();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->unsignedBigInteger('id_jenis_publikasi');
            $table->timestamps();

            $table->foreign('id_jenis_publikasi')->references('id_jenis_publikasi')->on('jenis_publikasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_publikasi');
        Schema::dropIfExists('publikasi');
    }
};
