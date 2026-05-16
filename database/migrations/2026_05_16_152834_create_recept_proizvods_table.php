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
        Schema::create('recept_proizvods', function (Blueprint $table) {
            $table->id('idReceptProizvod')->autoIncrement();
            $table->foreignId('idRecept')->references('idRecept')->on('recepts')->onDelete('cascade');
            $table->foreignId('idProizvod')->references('idProizvod')->on('proizvods')->onDelete('cascade');
            $table->decimal('potrebnaKolicina', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recept_proizvods');
    }
};
