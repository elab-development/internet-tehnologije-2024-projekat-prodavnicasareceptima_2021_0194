<?php

namespace Database\Seeders;

use HashContext;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        User::create([
            'korisnickoIme' => 'Admin',
            'lozinka' => Hash::make('admin123'),
            'tipKorisnika' => 'admin'
        ]);

        $this->call([
            //ProizvodSeeder::class,
            //KupovinaSeeder::class,
            //KupovinaStavkaSeeder::class,
            //ReceptSeeder::class,
            //ReceptProizvodSeeder::class
        ]);
    }
}
