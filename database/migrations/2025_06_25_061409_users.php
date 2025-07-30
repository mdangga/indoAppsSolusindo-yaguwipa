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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'donatur', 'mitra'])->default('donatur');
            $table->string('nama');
            $table->string('profile_path')->nullable();
            $table->string('no_tlp');
            $table->string('email')->unique()->nullable();
            $table->text('alamat');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('review', function (Blueprint $table) {
            $table->id('id_review');
            $table->integer('rating')->nullable()->default(null);
            $table->string('review');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('review');
    }
};
