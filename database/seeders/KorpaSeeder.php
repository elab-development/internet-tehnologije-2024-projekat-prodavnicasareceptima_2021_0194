<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Proizvod;
use App\Models\Korpa;
use App\Models\KorpaStavka;

class KorpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $proizvodi = Proizvod::all();

        if ($users->isEmpty() || $proizvodi->isEmpty()) {
            return;
        }

        foreach ($users as $user) {

            $korpa = Korpa::create([
                'idUser' => $user->idUser,
                'ukupnaCena' => 0,
                'datumKreiranja' => now()
            ]);

            $brojStavki = rand(1, 5);
            $ukupnaCena = 0;

            for ($i = 0; $i < $brojStavki; $i++) {

                $proizvod = $proizvodi->random();
                $kolicina = rand(1, 3);

                // uzmi cenu proizvoda
                $cena = $proizvod->cena;

                // ukupno za stavku
                $cenaStavke = $cena * $kolicina;

                KorpaStavka::create([
                    'idKorpa' => $korpa->idKorpa ?? $korpa->id,
                    'idProizvod' => $proizvod->idProizvod ?? $proizvod->id,
                    'kolicina' => $kolicina,
                    'cena' => $cenaStavke
                ]);

                $ukupnaCena += $cenaStavke;
            }

            // update korpe sa ukupnom cenom
            $korpa->update([
                'ukupnaCena' => $ukupnaCena
            ]);
        }
    }
}
