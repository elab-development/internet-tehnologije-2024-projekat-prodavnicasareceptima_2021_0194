<?php

namespace Database\Seeders;

use App\Models\Proizvod;
use App\Models\Recept;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Recept::factory()->create();

        $ovsene = Proizvod::query()->where('naziv', 'Ovsene pahuljice')->first();
        $banana = Proizvod::query()->where('naziv', 'Banana')->first();
        $med = Proizvod::query()->where('naziv', 'Med')->first();
        $jaja = Proizvod::query()->where('naziv', 'Jaja')->first();
        $mleko = Proizvod::query()->where('naziv', 'Bademovo mleko')->first();
        $kakao = Proizvod::query()->where('naziv', 'Kakao prah')->first();
        $brasno = Proizvod::query()->where('naziv', 'Integralno brašno')->first();
        $ulje = Proizvod::query()->where('naziv', 'Kokosovo ulje')->first();

        // 1. Ovsena kaša
        $r1 = Recept::create([
            'naziv' => 'Ovsena kaša sa bananom',
            'uputstvo' => 'U šerpu sipaj bademovo mleko i zagrej ga na srednjoj 
            temperaturi do blagog ključanja. Dodaj ovsene pahuljice i kuvaj uz 
            stalno mešanje 5 do 7 minuta dok ne dobiju kremastu strukturu. Skloni sa 
            ringle i ostavi minut da odstoji. Izgnječi bananu viljuškom i umešaj u 
            kašu zajedno sa medom. Po želji dodaj cimet, orahe ili chia semenke za 
            dodatnu nutritivnu vrednost.',
            'vremePripreme' => 10,
            'kategorija' => 'Doručak',
            'brojKalorija' => 320,
            'brojPorcija' => 1,
        ]);

        $r1->receptProizvod()->attach([
            $ovsene->idProizvod => ['potrebnaKolicina' => 50],
            $banana->idProizvod => ['potrebnaKolicina' => 1],
            $med->idProizvod => ['potrebnaKolicina' => 10],
            $mleko->idProizvod => ['potrebnaKolicina' => 200],
        ]);

        // 2. Palačinke
        $r2 = Recept::create([
            'naziv' => 'Proteinske palačinke',
            'uputstvo' => 'U blender ubaci jaja, ovsene pahuljice 
            i bananu pa miksaj dok ne dobiješ glatku smesu. Ako je 
            smesa pregusta, dodaj malo bademovog mleka. Na tiganju 
            zagrej kokosovo ulje na srednjoj temperaturi. Sipaj smesu 
            i formiraj palačinke srednje veličine. Peci 2 do 3 minuta sa 
            svake strane dok ne porumene. Služiti uz voće, med ili puter 
            od kikirikija po želji.',
            'vremePripreme' => 15,
            'kategorija' => 'Doručak',
            'brojKalorija' => 410,
            'brojPorcija' => 2,
        ]);

        $r2->receptProizvod()->attach([
            $jaja->idProizvod => ['potrebnaKolicina' => 2],
            $ovsene->idProizvod => ['potrebnaKolicina' => 60],
            $banana->idProizvod => ['potrebnaKolicina' => 1],
            $ulje->idProizvod => ['potrebnaKolicina' => 5],
        ]);

        // 3. Čokoladni kolač
        $r3 = Recept::create([
            'naziv' => 'Zdravi čokoladni kolač',
            'uputstvo' => 'U velikoj posudi pomešaj jaja, 
            izgnječene banane, kakao prah i integralno brašno. 
            Mešaj dok ne dobiješ homogenu smesu bez grudvica. Po 
            potrebi dodaj malo mleka da smesa bude maziva. Sipaj u 
            kalup obložen papirom za pečenje i poravnaj površinu. Peci 
            u prethodno zagrejanoj rerni na 180°C oko 25 do 30 minuta. Proveri 
            čačkalicom da li je kolač pečen. Ohladi pre sečenja i serviranja.',
            'vremePripreme' => 35,
            'kategorija' => 'Desert',
            'brojKalorija' => 280,
            'brojPorcija' => 4,
        ]);

        $r3->receptProizvod()->attach([
            $jaja->idProizvod => ['potrebnaKolicina' => 3],
            $kakao->idProizvod => ['potrebnaKolicina' => 20],
            $banana->idProizvod => ['potrebnaKolicina' => 2],
            $brasno->idProizvod => ['potrebnaKolicina' => 80],
            $ulje->idProizvod => ['potrebnaKolicina' => 10],
        ]);

    }
}
