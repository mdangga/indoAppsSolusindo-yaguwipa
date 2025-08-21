<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->id('id_campaign');
            $table->string('slug')->unique();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('image_path');
            $table->decimal('target_dana', 15, 2)->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'selesai', 'pending'])->default('pending');
            $table->string('lokasi');
            $table->unsignedBigInteger('id_program');
            $table->timestamps();

            $table->foreign('id_program')->references('id_program')->on('program');
        });

        Schema::create('jenis_donasi', function (Blueprint $table) {
            $table->id('id_jenis_donasi');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->string('nama');
            $table->string('email');
            $table->string('alasan')->nullable();
            $table->text('pesan')->nullable();

            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->boolean('anonim');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_campaign');
            $table->unsignedBigInteger('id_jenis_donasi');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_campaign')->references('id_campaign')->on('campaign');
            $table->foreign('id_jenis_donasi')->references('id_jenis_donasi')->on('jenis_donasi');
        });

        Schema::create('donasi_dana', function (Blueprint $table) {
            $table->id('id_donasi_dana');
            $table->decimal('nominal', 15, 2);
            $table->decimal('admin_fee', 10, 2);
            $table->string('payment_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_url')->nullable();
            $table->enum('status_verifikasi', ['PAID', 'PENDING', 'VOIDED'])->default('PENDING');
            $table->datetime('paid_at')->nullable();
            $table->datetime('expired_at')->nullable();
            $table->unsignedBigInteger('id_donasi');
            $table->timestamps();

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi');
        });

        Schema::create('donasi_barang', function (Blueprint $table) {
            $table->id('id_donasi_barang');
            $table->string('nama_barang')->nullable();
            $table->unsignedInteger('jumlah_barang')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('kondisi', ['baru', 'bekas']);
            $table->enum('status_verifikasi', ['approved', 'pending', 'rejected'])->default('pending');
            $table->unsignedBigInteger('id_donasi');
            $table->timestamps();

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi');
        });

        Schema::create('donasi_jasa', function (Blueprint $table) {
            $table->id('id_donasi_jasa');
            $table->string('jenis_jasa')->nullable();
            $table->string('durasi_jasa')->nullable();
            $table->enum('status_verifikasi', ['approved', 'pending', 'rejected'])->default('pending');
            $table->unsignedBigInteger('id_donasi');
            $table->timestamps();

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_jasa');
        Schema::dropIfExists('donasi_barang');
        Schema::dropIfExists('donasi_dana');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('jenis_donasi');
        Schema::dropIfExists('campaign');
    }
};
