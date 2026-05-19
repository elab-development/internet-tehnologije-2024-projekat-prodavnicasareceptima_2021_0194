<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceptProizvodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        
        return [
            'id_stavke' => $this->idReceptProizvod,
            'id_recepta' => $this->idRecept,
            
            //Podaci o samom proizvodu (naziv, slika, itd.)
            //Pristupamo im preko relacije 'proizvod' u pivot modelu
            'proizvod' => [
                'id' => $this->idProizvod,
                'naziv' => $this->proizvod->naziv ?? 'Nepoznat sastojak',
                'merna_jedinica' => $this->proizvod->mernaJedinica ?? '',
            ],

            'kolicina_u_receptu' => $this->potrebnaKolicina,
            
            //Primer spajanja podataka za lepsi ispis na frontendu
            'puni_opis' => $this->potrebnaKolicina . ' ' . ($this->proizvod->mernaJedinica ?? '') . ' ' . ($this->proizvod->naziv ?? '')
        ];
    }
}
