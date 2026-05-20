<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KupovinaStavkaResource extends JsonResource
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
            'id_stavke_kupovine' => $this->idKupovinaStavka,
            'naziv_proizvoda' => $this->proizvod->naziv ?? 'Proizvod vise ne postoji',
            'kolicina' => $this->kolicina,
            'cena_u_trenutku_kupovine' => $this->cena . ' RSD',
            'cena_ukupna_po_proizvodu' => ($this->kolicina * $this->cena) . ' RSD',
        ];
    }
}
