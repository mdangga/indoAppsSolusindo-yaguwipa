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
        Schema::create('mitra', function (Blueprint $table) {
            $table->id('id_mitra');
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_tlp');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('penanggung_jawab');
            $table->string('jabatan_penanggung_jawab');
            $table->enum('status', ['show', 'hide']);
            $table->timestamps();

            $table->foreign('id_user')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};