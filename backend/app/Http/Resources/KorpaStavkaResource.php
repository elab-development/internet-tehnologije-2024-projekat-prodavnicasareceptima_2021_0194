<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KorpaStavkaResource extends JsonResource
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
            'id_stavke' => $this->idKorpaStavka,
            'proizvod' => [
                'id' => $this->idProizvod,
                'naziv' => $this->proizvod->naziv ?? 'Nepoznat proizvod',
            ],
            'kolicina' => $this->kolicina,
            'cena_po_komadu' => $this->cena . ' RSD',
            'ukupno' => ($this->kolicina * $this->cena) . ' RSD',
        ];
    }
}
