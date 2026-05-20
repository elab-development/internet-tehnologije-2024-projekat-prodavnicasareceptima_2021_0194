<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ReceptProizvodResource;

class ReceptResource extends JsonResource
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
            'id' => $this->idRecept,
            'naziv_jela' => $this->naziv,
            'uputstvo_za_pripremu' => $this->uputstvo,
            'vreme_pripreme' => $this->vremePripreme . ' min',
            'nutritivne_vrednosti' => [
                'kalorije' => $this->brojKalorija,
                'broj_porcija' => $this->brojPorcija,
            ],
            'kategorija' => $this->kategorija,
            'slika' => $this->slika,

            'kreiran' => $this->created_at->format('d.m.Y H:i'),
            'azuriran' => $this->updated_at->format('d.m.Y H:i'),

            // KLJUČNI DEO: Povezivanje sa proizvodima
            // Koristimo ProizvodResource::collection da formatiramo svaki sastojak
            // whenLoaded osigurava da se ovo desi samo ako smo uradili ->with() u kontroleru
            'sastojci' => ProizvodResource::collection($this->whenLoaded('receptProizvod')),

            //'sastojci' => ReceptProizvodResource::collection($this->whenLoaded('receptProizvod')),
        ];
    }
}
