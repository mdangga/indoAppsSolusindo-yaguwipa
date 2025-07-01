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
        Schema::create('menus', function(Blueprint $table){
            $table->id('id_menus');
            $table->string('nama_menu');
            $table->string('link');
            $table->timestamps();
        });

        Schema::create('sub_menus', function(Blueprint $table){
            $table->id('id_sub_menus');
            $table->string('nama_menu');
            $table->string('link');
            $table->unsignedBigInteger('id_menus');
            $table->timestamps();

            $table->foreign('id_menus')->references('id_menus')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('sub_menus');
    }
};
