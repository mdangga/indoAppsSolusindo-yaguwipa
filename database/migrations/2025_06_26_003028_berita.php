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
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('slug');
            $table->longText('isi_berita');
            $table->string('thumbnail')->nullable();
            $table->string('keyword')->nullable();
            $table->dateTime('tanggal_publish')->nullable();
            $table->boolean('is_dipublish')->default(false);
            $table->unsignedInteger('dibaca')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
