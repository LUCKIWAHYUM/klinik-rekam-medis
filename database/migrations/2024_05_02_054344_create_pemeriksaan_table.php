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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->date('tgl_kunjungan')->nullable();
            $table->time('waktu_kunjungan')->nullable();
            $table->enum('status',['0','1','2'])->nullable();
            $table->string('no_periksa')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('tb')->nullable();
            $table->string('td')->nullable();
            $table->string('bb')->nullable();
            $table->string('nadi')->nullable();
            $table->string('spo2')->nullable();
            $table->string('pernapasan')->nullable();
            $table->string('periksalain')->nullable();
            $table->string('alergi')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('keterangan_dokter')->nullable();
            $table->string('diameter')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('posisi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
