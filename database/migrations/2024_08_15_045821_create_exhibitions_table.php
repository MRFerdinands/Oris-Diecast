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
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event', 100);
            $table->date('tgl_mulai_event');
            $table->date('tgl_selesai_event');
            $table->string('alamat_event', 150);
            $table->string('lokasi_booth', 20);
            $table->string('nama_eo');
            $table->string('gambar_banner_1', 100);
            $table->string('gambar_banner_2', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibitions');
    }
};