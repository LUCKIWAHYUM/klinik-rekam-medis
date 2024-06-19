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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('no_rmd')->unique();
            $table->string('nik');
            $table->string('nama_pasien');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('usia');
            $table->string('agama');
            $table->string('pekerjaan')->nullable();
            $table->string('alamat');
            $table->string('no_telp');
            $table->enum('biaya', ['Umum', 'Dana_Sehat']);
            $table->string('no_dana_sehat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
