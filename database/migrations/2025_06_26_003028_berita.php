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
        Schema::create('kategori_news_event', function(Blueprint $table){
            $table->id('id_kategori_news_event');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('news_event', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('slug');
            $table->longText('isi_berita');
            $table->string('thumbnail')->nullable();
            $table->string('caption')->nullable();
            $table->string('keyword')->nullable();
            $table->dateTime('tanggal_publish')->nullable();
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->unsignedInteger('hit')->default(0);
            $table->unsignedBigInteger('id_kategori_news_event');
            $table->timestamps();

            $table->foreign('id_kategori_news_event')->references('id_kategori_news_event')->on('kategori_news_event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_event');
        Schema::dropIfExists('kategori_news_event');
    }
};
