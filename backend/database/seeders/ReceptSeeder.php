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
        $ovsenoMleko= Proizvod::query()->where('naziv', 'Ovseno mleko')->first();
        $med = Proizvod::query()->where('naziv', 'Med')->first();
        $jagode= Proizvod::query()->where('naziv', 'Jagode')->first();
        $badem = Proizvod::query()->where('naziv', 'Badem')->first();
        $speltaPasta= Proizvod::query()->where('naziv', 'Integralna testenina od spelte')->first();
        $avokado= Proizvod::query()->where('naziv', 'Avokado')->first();
        $maslinovoUlje= Proizvod::query()->where('naziv', 'Maslinovo ulje')->first();
        $krastavac= Proizvod::query()->where('naziv', 'Krastavac')->first();
        $susam= Proizvod::query()->where('naziv', 'Susam')->first();
        $kokosovoBrasno= Proizvod::query()->where('naziv', 'Kokosovo brasno')->first();
        $bademovoMleko= Proizvod::query()->where('naziv', 'Bademovo mleko')->first();
        $karfiol= Proizvod::query()->where('naziv', 'Karfiol')->first();

/* // 1. Ovsena kaša
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
            'slika'=> 'https://cravingcalifornia.com/wp-content/uploads/2024/09/Overnight-Oats-3.jpg'
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
            'slika'=>'https://images.immediate.co.uk/production/volatile/sites/30/2021/02/Protein-pancakes-b64bd40.jpg'
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
            'slika'=>'https://dishingouthealth.com/wp-content/uploads/2021/11/ChocolatePeanutButterCookies_Square.jpg'
        ]);

        $r3->receptProizvod()->attach([
            $jaja->idProizvod => ['potrebnaKolicina' => 3],
            $kakao->idProizvod => ['potrebnaKolicina' => 20],
            $banana->idProizvod => ['potrebnaKolicina' => 2],
            $brasno->idProizvod => ['potrebnaKolicina' => 80],
            $ulje->idProizvod => ['potrebnaKolicina' => 10],
        ]);*/
        $r4 = Recept::create([
            'naziv' => 'Energetska ovsena kaša sa jagodama',
            'uputstvo' => 'U malu šerpu sipajte ovseno mleko i dodajte ovsene pahuljice. Kuvajte na umerenoj vatri uz stalno mešanje dok se smesa ne zgusne (oko 5-7 minuta). Sklonite sa vatre i umešajte kašiku meda. Sipajte u činiju, odozgo poređajte sveže iseckane jagode i pospite sitno seckanim bademima za hrskavost.',
            'vremePripreme' => 10,
            'kategorija' => 'Doručak',
            'brojKalorija' => 320,
            'brojPorcija' => 1,
            'slika' => 'https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?q=80&w=500&auto=format&fit=crop'
        ]);

        $r4->receptProizvod()->attach([
            $ovsene->idProizvod => ['potrebnaKolicina' => 50],
            $ovsenoMleko->idProizvod => ['potrebnaKolicina' => 200],
            $med->idProizvod => ['potrebnaKolicina' => 15],
            $jagode->idProizvod => ['potrebnaKolicina' => 100],
            $badem->idProizvod => ['potrebnaKolicina' => 10],
        ]);
        $r5 = Recept::create([
            'naziv' => 'Speltina pasta u kremastom avokado sosu',
            'uputstvo' => 'Skuvajte integralnu testeninu od spelte u ključaloj slanoj vodi prema uputstvu sa pakovanja. Dok se pasta kuva, u blenderu napravite sos od zrelog avokada, malo maslinovog ulja i prstohvata soli. Oceđenu pastu pomešajte sa sosom. Poslužite uz sveže iseckan krastavac i pospite susamom.',
            'vremePripreme' => 15,
            'kategorija' => 'Ručak',
            'brojKalorija' => 450,
            'brojPorcija' => 2,
            'slika' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop'
        ]);

        $r5->receptProizvod()->attach([
            $speltaPasta->idProizvod => ['potrebnaKolicina' => 160],
            $avokado->idProizvod => ['potrebnaKolicina' => 1],
            $maslinovoUlje->idProizvod => ['potrebnaKolicina' => 10],
            $krastavac->idProizvod => ['potrebnaKolicina' => 100],
            $susam->idProizvod => ['potrebnaKolicina' => 5],
        ]);
        $r7 = Recept::create([
            'naziv' => 'Fit banana palačinke bez brašna',
            'uputstvo' => 'Izgnječite dve zrele banane viljuškom dok ne postanu kaša. Umutite dva jaja i pomešajte sa bananama. Dodajte malo kokosovog brašna da smesa postane gušća. Pecite male palačinke na par kapi kokosovog ulja. Služite toplo, preliveno sa malo meda i posuto seckanim bademima.',
            'vremePripreme' => 15,
            'kategorija' => 'Desert',
            'brojKalorija' => 240,
            'brojPorcija' => 2,
            'slika' => 'https://images.unsplash.com/photo-1528207776546-365bb710ee93?q=80&w=500&auto=format&fit=crop'
        ]);

        $r7->receptProizvod()->attach([
            $banana->idProizvod => ['potrebnaKolicina' => 2],
            $jaja->idProizvod => ['potrebnaKolicina' => 2],
            $kokosovoBrasno->idProizvod => ['potrebnaKolicina' => 30],
            $ulje->idProizvod => ['potrebnaKolicina' => 5],
            $med->idProizvod => ['potrebnaKolicina' => 10],
        ]);
        $r8 = Recept::create([
            'naziv' => 'Kremasti čokoladni avokado mus',
            'uputstvo' => 'U blender stavite očišćen avokado, kakao prah, tri kašike meda i malo bademovog mleka. Blendajte dok ne dobijete potpuno glatku teksturu. Ako je previše gusto, dodajte još malo mleka. Sipajte u činijice i ostavite u frižideru sat vremena da se stegne. Pre serviranja pospite listićima badema.',
            'vremePripreme' => 10,
            'kategorija' => 'Desert',
            'brojKalorija' => 210,
            'brojPorcija' => 2,
            'slika' => 'https://images.unsplash.com/photo-1528950304401-fbef8d22c40e?q=80&w=500&auto=format&fit=crop'
        ]);

        $r8->receptProizvod()->attach([
            $avokado->idProizvod => ['potrebnaKolicina' => 2],
            $kakao->idProizvod => ['potrebnaKolicina' => 30],
            $med->idProizvod => ['potrebnaKolicina' => 40],
            $bademovoMleko->idProizvod => ['potrebnaKolicina' => 50],
            $badem->idProizvod => ['potrebnaKolicina' => 10],
        ]);
        $r12 = Recept::create([
        'naziv' => 'Ovsene energetske štanglice sa kakaom',
        'uputstvo' => 'Pomešajte ovsene pahuljice, sitno seckane bademe, kakao i susam. Zagrejte med i kokosovo ulje dok ne postanu tečni, pa prelijte preko suvih sastojaka. Dobro sjedinite, utisnite u pravougaoni kalup i ostavite u frižideru da se stegne par sati. Isecite na štanglice.',
        'vremePripreme' => 15,
        'kategorija' => 'Užina',
        'brojKalorija' => 150,
        'brojPorcija' => 8,
        'slika' => 'https://images.unsplash.com/photo-1590080874088-eec64895b423?q=80&w=500&auto=format&fit=crop'
        ]);

        $r12->receptProizvod()->attach([
            $ovsene->idProizvod => ['potrebnaKolicina' => 250],
            $badem->idProizvod => ['potrebnaKolicina' => 50],
            $kakao->idProizvod => ['potrebnaKolicina' => 20],
            $med->idProizvod => ['potrebnaKolicina' => 80],
            $ulje->idProizvod => ['potrebnaKolicina' => 20],
            $susam->idProizvod => ['potrebnaKolicina' => 15],
        ]);
        $r9 = Recept::create([
            'naziv' => 'Osvežavajuća avokado-krastavac salata',
            'uputstvo' => 'Isecite krastavac na tanke kolutove, a avokado na kockice. Pomešajte ih u činiji. Za dresing koristite maslinovo ulje i malo soli. Sve dobro promešajte i obilno pospite susamom koji ste prethodno kratko propekli na tiganju radi jače arome.',
            'vremePripreme' => 10,
            'kategorija' => 'Večera',
            'brojKalorija' => 310,
            'brojPorcija' => 1,
            'slika' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=500&auto=format&fit=crop'
        ]);

        $r9->receptProizvod()->attach([
            $krastavac->idProizvod => ['potrebnaKolicina' => 200],
            $avokado->idProizvod => ['potrebnaKolicina' => 1],
            $maslinovoUlje->idProizvod => ['potrebnaKolicina' => 15],
            $susam->idProizvod => ['potrebnaKolicina' => 10],
        ]);
        $r10 = Recept::create([
            'naziv' => 'Integralni mafini sa jagodama i bademom',
            'uputstvo' => 'Umutite jaja sa medom i otopljenim kokosovim uljem. Dodajte integralno brašno i malo bademovog mleka da dobijete gustu smesu. Na kraju nežno umešajte seckane jagode. Sipajte u kalupe za mafine i pecite 20 minuta na 180°C. Služite uz čaj ili kafu.',
            'vremePripreme' => 30,
            'kategorija' => 'Desert',
            'brojKalorija' => 190,
            'brojPorcija' => 6,
            'slika' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=500&auto=format&fit=crop'
        ]);

        $r10->receptProizvod()->attach([
            $brasno->idProizvod => ['potrebnaKolicina' => 200],
            $jaja->idProizvod => ['potrebnaKolicina' => 2],
            $med->idProizvod => ['potrebnaKolicina' => 60],
            $jagode->idProizvod => ['potrebnaKolicina' => 150],
            $ulje->idProizvod => ['potrebnaKolicina' => 30],
            $bademovoMleko->idProizvod => ['potrebnaKolicina' => 100],
        ]);
        $r11 = Recept::create([
            'naziv' => 'Hrskavi karfiol u kokosovom brašnu',
            'uputstvo' => 'Cvetove karfiola umočite u umućena jaja, a zatim u mešavinu kokosovog brašna i susama. Ređajte na pleh i poprskajte maslinovim uljem. Pecite dok ne postane zlatno i hrskavo. Ovaj recept je odličan prilog uz meso ili kao samostalan lagani ručak.',
            'vremePripreme' => 40,
            'kategorija' => 'Ručak',
            'brojKalorija' => 250,
            'brojPorcija' => 3,
            'slika' => 'https://images.unsplash.com/photo-1603048588665-791ca8aea617?q=80&w=500&auto=format&fit=crop'
        ]);

        $r11->receptProizvod()->attach([
            $karfiol->idProizvod => ['potrebnaKolicina' => 600],
            $jaja->idProizvod => ['potrebnaKolicina' => 2],
            $kokosovoBrasno->idProizvod => ['potrebnaKolicina' => 50],
            $susam->idProizvod => ['potrebnaKolicina' => 20],
            $maslinovoUlje->idProizvod => ['potrebnaKolicina' => 15],
        ]);
    }
}
