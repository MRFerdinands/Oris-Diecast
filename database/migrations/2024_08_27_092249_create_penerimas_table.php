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
        Schema::create('penerima', function (Blueprint $table) {
            $table->id('kode_penerima');
            $table->string('nama_penerima', 40);
            $table->string('alamat_penerima_1', 30);
            $table->string('alamat_penerima_2', 30);
            $table->string('alamat_penerima_3', 30);
            $table->string('alamat_penerima_4', 30);
            $table->string('kode_pos_penerima', 5);
            $table->string('telp_penerima', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimas');
    }
};