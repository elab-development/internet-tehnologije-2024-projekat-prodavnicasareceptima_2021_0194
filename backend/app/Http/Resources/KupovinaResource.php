<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KupovinaResource extends JsonResource
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
            'broj_racuna' => $this->idKupovina,
            'podaci_o_kupcu' => [
                'ime' => $this->imeKupca,
                'prezime' => $this->prezimeKupca,
                'email' => $this->emailKupca,
                'adresa' => $this->adresaIsporuke,
            ],
            'datum_transakcije' => $this->datumKupovine,
            'ukupno_placeno' => $this->ukupnaCena . ' RSD',
            // Lista svih kupljenih stvari
            'kupljeni_proizvodi' => KupovinaStavkaResource::collection($this->whenLoaded('kupovinaStavka')), //naziv relacije u modelu
        ];
    }
}
