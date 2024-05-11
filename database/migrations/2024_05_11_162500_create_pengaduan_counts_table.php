<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // PENGADUAN COUNTS
    public function up(): void
    {
        Schema::create('pengaduan_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->references('id')->on('pengaduans')->cascadeOnDelete();
            $table->integer('counts');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pengaduan_counts');
    }
};
