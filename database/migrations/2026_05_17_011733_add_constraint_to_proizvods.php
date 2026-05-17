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
        Schema::table('proizvods', function (Blueprint $table) {
            //Dodajemo ogranicenje da cena mora biti veca od nula
            DB::statement('ALTER TABLE proizvods ADD CONSTRAINT check_cena_pozitivna CHECK (cena > 0)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proizvods', function (Blueprint $table) {
            //Brisanje ograničenja
            DB::statement('ALTER TABLE proizvods DROP CONSTRAINT check_cena_pozitivna');
        });
    }
};
