<?php

namespace Database\Factories;

use App\Models\Korpa;
use App\Models\KorpaStavka;
use App\Models\Proizvod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KorpaStavka>
 */
class KorpaStavkaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Povezuje stavku sa nasumicnom korpom
            'idKorpa' => Korpa::factory(), 
            // Povezuje stavku sa nasumicnim proizvodom
            'idProizvoda' => Proizvod::factory(), 
            // Nasumicna količina između 1 i 5
            'kolicina' => $this->faker->numberBetween(1, 5),
            // Nasumicna cena proizvoda
            'cena' => $this->faker->randomFloat(2, 50, 2000), 
        ];
    }
}
