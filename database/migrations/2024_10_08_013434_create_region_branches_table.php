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
        Schema::create('region_branches', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->foreign('region_id')->references('on')->on('regions');
            $table->foreign('branch_id')->references('on')->on('branches');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_branches');
    }
};
