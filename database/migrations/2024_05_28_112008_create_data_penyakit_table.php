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
        Schema::create('data_penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('kode'); // Assuming 'kode' is a string column
            $table->string('nama_penyakit'); // Assuming 'nama_penyakit' is a string column
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penyakit');
    }
};
