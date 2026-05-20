<?php

namespace Database\Factories;

use App\Models\Recept;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recept>
 */
class ReceptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Generise naziv od tri reci
            'naziv' => $this->faker->sentence(3), 
            //Generise duzi tekst sa vise recenica
            'uputstvo' => $this->faker->paragraph(),
            //Generise nasumican broj izmedju 20 i 180(u minutima)
            'vremePripreme' => $this->faker->numberBetween(20, 180),
            'kategorija' => $this->faker->randomElement(['Dorucak', 'Rucak', 'Vecera','Salate', 'Deserti']),
            'brojKalorija' => $this->faker->numberBetween(200, 1000),
            'brojPorcija' => $this->faker->numberBetween(1, 10)
        ];
    }
}
