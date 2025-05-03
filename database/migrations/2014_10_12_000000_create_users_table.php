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
            $table->string('cover')->unique();
            $table->string('name');
            $table->string('nis')->unique()->nullable();
            $table->string('email')->unique();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kelas')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'siswa', 'superadmin', 'guru'])->default('siswa');
            $table->enum('status', ['active', 'nonactive'])->default('active');
            $table->bigInteger('point')->nullable();
            $table->integer('semester')->nullable();
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
