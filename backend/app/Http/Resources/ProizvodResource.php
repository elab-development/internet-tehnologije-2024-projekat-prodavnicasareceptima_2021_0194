<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProizvodResource extends JsonResource
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
            'id' => $this->idProizvod,
            'naziv' => $this->naziv,
            'cena' => $this->cena . ' RSD',
            'kategorija' => $this->kategorija,
            'merna_jedinica' => $this->mernaJedinica,
            'slika_url' => $this->slika
        ];
    }
}
