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
        Schema::create('brands', function (Blueprint $table) {
            $table->string('kode_brand', 10)->primary();
            $table->string('nama_brand', 30);
            $table->string('logo_brand', 100);
            $table->string('gambar_produk_1', 100);
            $table->string('gambar_produk_2', 100)->nullable();
            $table->string('gambar_produk_3', 100)->nullable();
            $table->string('gambar_produk_4', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};