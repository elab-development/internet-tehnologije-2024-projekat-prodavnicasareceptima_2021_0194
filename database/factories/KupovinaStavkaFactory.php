<?php

namespace Database\Factories;

use App\Models\KupovinaStavka;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Kupovina;
use App\Models\Proizvod;

/**
 * @extends Factory<KupovinaStavka>
 */
class KupovinaStavkaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kolicina' => $this->faker->numberBetween(1, 10),
            'cena' => $this->faker->randomFloat(2, 10, 1000),
            //Kreira novu kupovinu ako ne postoji i upisuje njen id
            'idKupovina' => Kupovina::factory(),
            'idProizvod' => Proizvod::factory()
        ];
    }
}
