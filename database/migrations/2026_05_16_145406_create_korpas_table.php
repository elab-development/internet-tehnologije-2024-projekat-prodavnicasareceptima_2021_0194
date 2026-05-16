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
        Schema::create('korpas', function (Blueprint $table) {
            $table->id('idKorpa')->autoIncrement();
            $table->foreignId('idUser')->references('idUser')->on('users')->onDelete('cascade');
            $table->dateTime('datumKreiranja');
            $table->decimal('ukupnaCena', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korpas');
    }
};
