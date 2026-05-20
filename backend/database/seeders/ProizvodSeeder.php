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
        //Proizvod::factory(15)->create();
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

        /*$proizvodi = [
            [
                'naziv' => 'Kupine',
                'kategorija' => 'Voce',
                'cena' => 175.00,
                'mernaJedinica' => "g"
            ],
            [
                'naziv' => 'Mango',
                'kategorija' => 'Voce',
                'cena' => 380.99,
                'mernaJedinica' => "kg"
            ],
            [
                'naziv' => 'Ulje',
                'kategorija' => 'Osnovne namirnice',
                'cena' => 190.00,
                'mernaJedinica' => "l"
            ],
        ];
        foreach ($proizvodi as $proizvod) {
            Proizvod::create($proizvod);
        }*/

        $proizvodi = [
            [
                'naziv' => 'Ovsene pahuljice',
                'cena' => 180,
                'kategorija' => 'Zitarice',
                'mernaJedinica' => 'g'
            ],
            [
                'naziv' => 'Banana',
                'cena' => 180,
                'kategorija' => 'Voce',
                'mernaJedinica' => 'kg'
            ],
            [
                'naziv' => 'Med',
                'cena' => 450,
                'kategorija' => 'Zasladjivaci',
                'mernaJedinica' => 'g'
            ],
            [
                'naziv' => 'Jaja',
                'cena' => 25,
                'kategorija' => 'Mlecni proizvodi',
                'mernaJedinica' => 'kom'
            ],
            [
                'naziv' => 'Bademovo mleko',
                'cena' => 320,
                'kategorija' => 'Napici',
                'mernaJedinica' => 'ml'
            ],
            [
                'naziv' => 'Kakao prah',
                'cena' => 600,
                'kategorija' => 'Zasladjivaci',
                'mernaJedinica' => 'g'
            ],
            [
                'naziv' => 'Integralno brašno',
                'cena' => 120,
                'kategorija' => 'Zitarice',
                'mernaJedinica' => 'g'
            ],
            [
                'naziv' => 'Kokosovo ulje',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml'
            ],
        ];

        foreach ($proizvodi as $proizvod) {
            Proizvod::create($proizvod);
        }
    }
}
