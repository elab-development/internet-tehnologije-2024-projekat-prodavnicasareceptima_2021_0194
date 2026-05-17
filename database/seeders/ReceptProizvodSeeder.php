<?php

namespace Database\Seeders;

use App\Models\ReceptProizvod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptProizvodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ReceptProizvod::factory()->create();
    }
}
