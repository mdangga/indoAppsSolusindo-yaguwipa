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
        Schema::create('profil_yayasan', function (Blueprint $table) {
            $table->id('id_profil_yayasan');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('background')->nullable();
            $table->string('company');
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('map')->nullable();
            $table->text('intro')->nullable();
            $table->string('popup')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('copyright')->nullable();
            $table->text('tentang')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('makna_logo')->nullable();
        });

        Schema::create('sosial_media', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('link');
            $table->string('icon');
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->unsignedBigInteger('id_profil_yayasan');

            $table->foreign('id_profil_yayasan')->references('id_profil_yayasan')->on('profil_yayasan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_yayasan');
        Schema::dropIfExists('sosial_media');
    }
};
