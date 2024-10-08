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
        Schema::create('cmo_kats', function (Blueprint $table) {
            $table->id();
            $table->integer('cmo_id')->unsigned();
            $table->integer('kat_id')->unsigned();
            $table->foreign('cmo_id')->references('id')->on('users');
            $table->foreign('kat_id')->references('id')->on('kats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmo_kats');
    }
};
