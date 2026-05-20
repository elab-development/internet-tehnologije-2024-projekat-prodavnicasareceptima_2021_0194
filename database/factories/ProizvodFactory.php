<?php

namespace Database\Factories;

use App\Models\Proizvod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Proizvod>
 */
class ProizvodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Generise slucajnu rec kao naziv
            'naziv'=>$this->faker->word(),
            //Cena između 10 i 2000 sa 2 decimale
            'cena'=>$this->faker->randomFloat(2, 10, 2000),
            //Slucajna kategorija
            'kategorija'=>$this->faker->randomElement(['Voce', 'Povrce', 'Osnovne namirnice','Meso', 'Mlecni proizvodi']),
            'mernaJedinica'=>$this->faker->randomElement(['kg', 'g', 'l', 'ml', 'kom'])
        ];
    }
}
