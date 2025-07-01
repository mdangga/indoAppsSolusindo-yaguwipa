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
            $table->string('logo');
            $table->string('favicon');
            $table->string('background');
            $table->string('company');
            $table->string('website');
            $table->string('telephone');
            $table->string('fax');
            $table->string('email');
            $table->string('address');
            $table->string('map');
            $table->string('intro');
            $table->string('popup');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->string('copyright');
            $table->string('tentang');
            $table->string('visi');
            $table->string('misi');
            $table->string('tujuan');
            $table->string('makna_logo');
        });

        Schema::create('sosial_media', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('link');
            $table->string('icon');
            $table->string('status');
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
