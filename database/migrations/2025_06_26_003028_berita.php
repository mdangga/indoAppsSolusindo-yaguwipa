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
        Schema::create('berita', function(Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('slug');
            $table->longText('isi_berita');
            $table->string('thumbnail')->nullable();
            // $table->unsignedBigInteger('id_editor');
            $table->dateTime('tanggal_publish')->nullable();
            $table->boolean('is_dipublish')->default(false);
            $table->unsignedInteger('dibaca')->default(0);
            $table->timestamps(); 

            // $table->foreign('id_editor')->references('id')->on('editor')->onDelete('cascade');
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
