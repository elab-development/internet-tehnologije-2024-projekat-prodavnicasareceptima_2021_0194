<?php

namespace Database\Factories;

use App\Models\Korpa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Korpa>
 */
class KorpaFactory extends Factory
{

    //da bi Laravel tacno znao za koji Model ovaj Factory treba da "izmislja" podatke
    //protected $model = Kupovina::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idUser' => User::factory(), 
            // Nasumičan datum u poslednjih mesec dana
            'datumKreiranja' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'ukupnaCena' => 0, 
        ];
    }
}
