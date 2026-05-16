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
        Schema::create('korpa_stavkas', function (Blueprint $table) {
            $table->id('idKorpaStavka')->autoIncrement();
            $table->dateTime('datumKreiranja');
            $table->decimal('ukupnaCena', 10, 2);
            $table->foreignId('idProizvod')->references('idProizvod')->on('proizvods')->onDelete('cascade');
            $table->foreignId('idKorpa')->references('idKorpa')->on('korpas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korpa_stavkas');
    }
};
