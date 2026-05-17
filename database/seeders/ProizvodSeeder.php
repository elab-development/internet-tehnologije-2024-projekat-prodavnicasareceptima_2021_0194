<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Proizvod;

class ProizvodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Generise dva proizvoda i cuva ih u bazi
        Proizvod::factory()->create();
        //Isto radi kao i zapis ispod
        //Proizvod::factory()->count(2)->create();

        /*Proizvod::factory()->create([
            'naziv' => 'Čokolada',
            'cena' => 250.00,
        ]);*/

        /*Proizvod::create([
            'naziv' => 'Marmelada',
            'cena' => 450.00,
        ]);*/
    }
}
