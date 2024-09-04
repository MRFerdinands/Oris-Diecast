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
        Schema::create('store_locations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko', 50);
            $table->string('alamat_toko', 250);
            $table->string('contact_person', 50);
            $table->string('phone_number', 50);
            $table->string('gambar_toko_1', 100);
            $table->string('gambar_toko_2', 100)->nullable();
            $table->string('gambar_toko_3', 100)->nullable();
            $table->string('gambar_toko_4', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_locations');
    }
};