<?php

namespace Database\Factories;

use App\Models\ReceptProizvod;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Recept;
use App\Models\Proizvod;

/**
 * @extends Factory<ReceptProizvod>
 */
class ReceptProizvodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Kolicina od 0.1 do 100 sa 2 decimale
            'potrebnaKolicina' => $this->faker->randomFloat(2, 0.1, 100),
            'idRecept' => Recept::factory(),
            'idProizvod' => Proizvod::factory()
        ];
    }
}
