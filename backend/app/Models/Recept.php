<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recept extends Model
{
    /** @use HasFactory<\Database\Factories\ReceptFactory> */
    use HasFactory;

    protected $primaryKey = 'idRecept';

    protected $fillable = [
        'naziv',
        'uputstvo',
        'vremePripreme',
        'kategorija',
        'brojKalorija',
        'brojPorcija',
    ];

    public function receptProizvod() {
        return $this->belongsToMany(Proizvod::class, 'recept_proizvods', 'idRecept', 'idProizvod')->withPivot('potrebnaKolicina');
    }

}
