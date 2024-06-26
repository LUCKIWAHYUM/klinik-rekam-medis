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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('tlp')->nullable();
            $table->string('nip')->nullable();
            $table->string('alamat')->nullable();
            $table->enum('status', ['aktif', 'tidak'])->default('aktif');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('password');
            $table->enum('role', ['admin', 'perawat', 'dokter', 'apoteker']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
