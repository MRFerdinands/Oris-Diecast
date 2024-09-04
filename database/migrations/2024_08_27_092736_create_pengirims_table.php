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
        Schema::create('pengirim', function (Blueprint $table) {
            $table->id('kode_pengirim');
            $table->string('nama_pengirim', 40);
            $table->string('telp_pengirim', 20);
            $table->enum('status_pengirim', ['A', 'NA'])->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirims');
    }
};