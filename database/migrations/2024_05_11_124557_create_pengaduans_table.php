<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // PENGADUAN
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('pengaduan_category_id')->references('id')->on('pengaduan_categories')->cascadeOnDelete();
            $table->foreignId('pengaduan_status_id')->default(1)->references('id')->on('pengaduan_statuses')->cascadeOnDelete();
            $table->foreignId('users_identifies_id')->references('id')->on('users_identifies')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->string('image');
            $table->string('slug')->unique();
            $table->timestamps();

            // Kolom untuk tanggapan
            $table->text('tanggapan_description')->nullable();
            $table->string('tanggapan_image')->nullable();
            // untuk status ikut atas bisa gak?
            
        });
    }


    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
