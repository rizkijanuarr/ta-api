<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // TANGGAPAN
    public function up(): void
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->references('id')->on('pengaduans')->cascadeOnDelete();
            $table->foreignId('tanggapan_status_id')->references('id')->on('status_tanggapans')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('description');
            $table->string('image');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('tanggapans');
    }
};
