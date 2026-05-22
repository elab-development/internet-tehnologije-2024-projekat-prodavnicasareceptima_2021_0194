<?php

namespace Database\Seeders;

use App\Models\Proizvod;
use App\Models\Recept;
use App\Models\ReceptProizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptProizvodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ReceptProizvod::factory()->create();

        /*ReceptProizvod::create([
            'idRecept' => 4,
            'idProizvod' => 6,
            'potrebnaKolicina' => 2.0
        ]);

        ReceptProizvod::create([
            'idRecept' => 4,
            'idProizvod' => 8,
            'potrebnaKolicina' => 2.0
        ]);*/

        $proizvodi = Proizvod::take(15)->get();
        $recepti = Recept::take(5)->get();

        foreach ($recepti as $recept) {

            $randomProizvodi = $proizvodi->random(rand(2, 6));

            foreach ($randomProizvodi as $proizvod) {
                $recept->receptProizvod()->attach($proizvod->idProizvod, [
                    'potrebnaKolicina' => rand(1, 500)
                ]);
            }
        }

    }
}
