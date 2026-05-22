<?php

namespace Database\Seeders;

use App\Models\Korpa;
use App\Models\KorpaStavka;
use App\Models\Proizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KorpaStavkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$korpe = Korpa::factory(3)->create();
        $proizvodi = Proizvod::factory(15)->create();

        foreach ($korpe as $korpa) {
            foreach ($proizvodi->random(rand(3, 7)) as $proizvod) {
                KorpaStavka::factory()->create([
                    'idKorpa' => $korpa->id,
                    'idProizvod' => $proizvod->id,
                ]);
            }
        }*/
    }
}
