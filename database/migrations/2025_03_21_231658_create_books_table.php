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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover', 2000)->nullable();
            $table->string('deskripsi', 2000)->nullable();
            $table->string('publisher')->nullable();
            $table->date('realese_date')->nullable();
            $table->bigInteger('stock');
            $table->enum('status', ['available', 'borrowed']);
            $table->enum('type', ['literasi', 'paketan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
