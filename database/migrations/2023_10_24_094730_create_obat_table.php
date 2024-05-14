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
        Schema::create('obat', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode_obat');
            $table->string('nama_obat');
            $table->string('stok');
            $table->string('harga');
            $table->enum('satuan',['tablet', 'kapsul', 'kaplet', 'pil', 'puyer','sirup', 'bedak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
