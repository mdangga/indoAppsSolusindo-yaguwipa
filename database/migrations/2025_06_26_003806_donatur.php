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
        Schema::create('donatur', function (Blueprint $table) {
            $table->id('id_donatur');
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('no_tlp');
            $table->string('profile_path');
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status', ['show', 'hide']);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};