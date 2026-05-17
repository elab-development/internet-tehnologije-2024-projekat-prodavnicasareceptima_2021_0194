<?php

namespace Database\Factories;

use App\Models\Kupovina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kupovina>
 */
class KupovinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Generise nasumicno ime osobe
            'imeKupca' => $this->faker->firstName,
            'prezimeKupca' => $this->faker->lastName,
            //safeEmail → pravi realistican email (npr. gmail, yahoo…)
            //unique() → osigurava da se email ne ponavlja
            'email' => $this->faker->unique()->safeEmail,
            'adresaIsporuke' => $this->faker->address,
            'datumKupovine' => $this->faker->date(),
            //Generiee decimalni broj od 10 do 10000 sa 2 decimale
            'ukupnaCena' => $this->faker->randomFloat(2, 10, 10000)
        ];
    }
}
