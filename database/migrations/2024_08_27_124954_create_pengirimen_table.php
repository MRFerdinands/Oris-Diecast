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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id('no_trx');
            $table->unsignedBigInteger('kode_pengirim');
            $table->foreign('kode_pengirim')->references('kode_pengirim')->on('pengirim')->onDelete('cascade');
            $table->string('nama_penerima', 40)->nullable();
            $table->string('telp_penerima', 20)->nullable();
            $table->string('alamat_penerima_1', 30)->nullable();
            $table->string('alamat_penerima_2', 30)->nullable();
            $table->string('alamat_penerima_3', 30)->nullable();
            $table->string('alamat_penerima_4', 30)->nullable();
            $table->string('kode_pos_penerima', 5)->nullable();
            $table->unsignedBigInteger('kode_penerima')->nullable();
            $table->foreign('kode_penerima')->references('kode_penerima')->on('penerima')->onDelete('cascade');
            $table->string('jenis_pengiriman', 3)->nullable();
            $table->string('catatan', 50)->nullable();
            $table->string('no_resi', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
