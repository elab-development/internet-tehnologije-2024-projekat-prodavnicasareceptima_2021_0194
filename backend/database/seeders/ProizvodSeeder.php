<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Proizvod;

class ProizvodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Generise dva proizvoda i cuva ih u bazi
        //Proizvod::factory(15)->create();
        //Isto radi kao i zapis ispod
        //Proizvod::factory()->count(2)->create();

        /*Proizvod::factory()->create([
            'naziv' => 'Čokolada',
            'cena' => 250.00,
        ]);*/

        /*Proizvod::create([
            'naziv' => 'Marmelada',
            'cena' => 450.00,
        ]);*/

        /*$proizvodi = [
            [
                'naziv' => 'Kupine',
                'kategorija' => 'Voce',
                'cena' => 175.00,
                'mernaJedinica' => "g"
            ],
            [
                'naziv' => 'Mango',
                'kategorija' => 'Voce',
                'cena' => 380.99,
                'mernaJedinica' => "kg"
            ],
            [
                'naziv' => 'Ulje',
                'kategorija' => 'Osnovne namirnice',
                'cena' => 190.00,
                'mernaJedinica' => "l"
            ],
        ];
        foreach ($proizvodi as $proizvod) {
            Proizvod::create($proizvod);
        }*/

        $proizvodi = [
            /*[
                'naziv' => 'Ovsene pahuljice',
                'cena' => 180,
                'kategorija' => 'Zitarice',
                'mernaJedinica' => 'g',
                'slika' => 'https://products.dm-static.com/images/f_auto,q_auto,c_fit,h_1200,w_1200/v1747487289/assets/pas/images/95fc3b1f-0739-40a3-b7ad-cc80c5020cac/dmbio-ovsene-pahuljice-veliki-listici'
            ],
            [
                'naziv' => 'Banana',
                'cena' => 180,
                'kategorija' => 'Voce',
                'mernaJedinica' => 'kg',
                'slika' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLWh-E-5rCitwZiTaKzesMB6kupUh0TRu1FQ&s'
            ],
            [
                'naziv' => 'Med',
                'cena' => 450,
                'kategorija' => 'Zasladjivaci',
                'mernaJedinica' => 'g',
                'slika' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLze7Hjwnsqi1jG5FdzCtTHTWh_X4JreFl9A&s'
            ],
            [
                'naziv' => 'Jaja',
                'cena' => 25,
                'kategorija' => 'Mlecni proizvodi',
                'mernaJedinica' => 'kom',
                'slika' => 'https://nfvdrprrerpxewkraypt.supabase.co/storage/v1/object/public/media-library/DomacaJajaAKlase.jpg'
            ],
            [
                'naziv' => 'Bademovo mleko',
                'cena' => 320,
                'kategorija' => 'Napici',
                'mernaJedinica' => 'ml',
                'slika' => 'https://static.maxi.rs/medias/sys_master/products/h84/hf0/9181610606622.jpg?buildNumber=db7e1af0a08b870381b882eed0e8a721808cd1978d3b653c44d7e3fbb561b918'
            ],
            [
                'naziv' => 'Kakao prah',
                'cena' => 600,
                'kategorija' => 'Zasladjivaci',
                'mernaJedinica' => 'g',
                'slika' => 'https://organico.rs/wp-content/uploads/2024/08/Organski-sirovi-kakao-prah-190g.webp'
            ],
            [
                'naziv' => 'Integralno brašno',
                'cena' => 120,
                'kategorija' => 'Zitarice',
                'mernaJedinica' => 'g',
                'slika' => 'https://products.dm-static.com/images/f_auto,q_auto,c_fit,h_1200,w_1200/v1755055795/assets/pas/images/b7d70697-c3b6-41e7-9f3e-a31fc432a12c/dmbio-integralno-speltino-brasno'
            ],
            [
                'naziv' => 'Kokosovo ulje',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLze7Hjwnsqi1jG5FdzCtTHTWh_X4JreFl9A&s'
            ],*/
            [
                'naziv' => 'Jagode',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://online.idea.rs/images/products/112/112000013_1l.jpg?1686655009'
            ],
            [
                'naziv' => 'Ovseno mleko',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://img.ep-cdn.com/i/500/500/ln/lnyzxdosbwitcghjkrup/imlek-napitak-od-ovsa-oaza-1l-cene.jpg'
            ],
            [
                'naziv' => 'Kokosovo brasno',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://products.dm-static.com/images/f_auto,q_auto,c_fit,h_1200,w_1200/v1747528164/assets/pas/images/c5ffeb5d-4bf3-4bbe-ba3a-901b24db4182/sanaterra-organsko-kokosovo-brasno'
            ],
            [
                'naziv' => 'Maslinovo ulje',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxumbMkFj9vfv8er5CdQ7eBqEwwmcwxuuH4g&s'
            ],
            [
                'naziv' => 'Avokado',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Avocado_Hass_-_single_and_halved.jpg/250px-Avocado_Hass_-_single_and_halved.jpg'
            ],
            [
                'naziv' => 'Badem',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://justsuperior.rs/wp-content/uploads/2020/01/sirovi-organski-badem-1.png'
            ],
            [
                'naziv' => 'Susam',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://products.dm-static.com/images/f_auto,q_auto,c_fit,h_1200,w_1200/v1766011367/assets/pas/images/50e84841-3d0c-4cf6-87b8-f3297f89e619/dmbio-neoljusteni-susam'
            ],
            [
                'naziv' => 'Krastavac',
                'cena' => 500,
                'kategorija' => 'Povrce',
                'mernaJedinica' => 'ml',
                'slika' => 'https://organico.rs/wp-content/uploads/2021/07/krastavac-2.jpg'
            ],
            [
                'naziv' => 'Karfiol',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://wiki.poljoinfo.com/wp-content/uploads/2016/03/plod-karfiola.jpg'
            ],
            [
                'naziv' => 'Integralna testenina od spelte',
                'cena' => 500,
                'kategorija' => 'Masti',
                'mernaJedinica' => 'ml',
                'slika' => 'https://products.dm-static.com/images/f_auto,q_auto,c_fit,h_1200,w_1200/v1747451164/assets/pas/images/528d13bb-88b4-4e51-99b8-cf700e852169/dmbio-integralna-testenina-od-spelte-spirale'
            ],
        ];

        foreach ($proizvodi as $proizvod) {
            Proizvod::create($proizvod);
        }
    }
}
