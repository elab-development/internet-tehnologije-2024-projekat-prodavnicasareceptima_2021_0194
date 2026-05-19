<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KorpaResource extends JsonResource
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
            'id_korpe' => $this->idKorpa,
            'vlasnik_id' => $this->idUser,
            'datum_kreiranja' => $this->datumKreiranja,
            'ukupna_vrednost_korpe' => $this->ukupnaCena . ' RSD',
            //Ovde "uvlacimo" sve stavke koristeci KorpaStavkaResource
            'stavke' => KorpaStavkaResource::collection($this->whenLoaded('korpaStavka')),
        ];   
    }
}
