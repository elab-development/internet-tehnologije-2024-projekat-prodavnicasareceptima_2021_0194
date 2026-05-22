<?php

namespace Database\Seeders;

use App\Models\Kupovina;
use App\Models\KupovinaStavka;
use App\Models\Proizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KupovinaStavkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KupovinaStavka::factory()->create();

        //Ako ne postoje u bazi
        //Kreiranje nekoliko kupovina i proizvoda, jer imamo spoljne kljuceve
        /*$proizvodi = Proizvod::factory(2)->create();
        $kupovine = Kupovina::factory(2)->create();*/

        //Popunjavanje pivot tabele(kupovina_stavkas) koristeci factory
        /*foreach ($kupovine as $k) {
            foreach ($proizvodi->random(rand(1, 5)) as $p) {
                KupovinaStavka::factory()->create([
                    'idProizvod' => $p->idProizvod,
                    'idKupovina' => $k->idKupovina,
                    'kolicina' => fake()->numberBetween(1, 10),
                    'cena' => fake()->numberBetween(10, 1000)
                ]);
            }
        }*/

        //Ako postoje u bazi proizvodi i kupovine
        /*for ($i = 0; $i < 3; $i++) {
            KupovinaStavka::create([
                'idKupovina' => Kupovina::inRandomOrder(null)->first()->idKupovina,
                'idProizvod' => Proizvod::inRandomOrder(null)->first()->idProizvod,
                'kolicina' => rand(1, 10),
                'cena' => rand(100, 1000),
            ]);
        }*/
    }
}
