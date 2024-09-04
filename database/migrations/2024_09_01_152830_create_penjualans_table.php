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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('no_urut');
            $table->string('kode_product', 50);
            $table->foreign('kode_product')->references('kode_product')->on('products')->onDelete('restrict');
            $table->decimal('harga_jual', 15, 2);
            $table->integer('qty');
            $table->string('kode_bayar', 10);
            $table->foreign('kode_bayar')->references('kode_bayar')->on('metode_pembayarans')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};