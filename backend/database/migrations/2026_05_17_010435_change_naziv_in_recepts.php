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
        Schema::table('recepts', function (Blueprint $table) {
            //Maksimalna duzina naziva
            $table->string('naziv', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recepts', function (Blueprint $table) {
            //Vracamo da naziv nema ogranicenja za duzinu
            $table->text('sadrzaj')->change(); 
        });
    }
};
