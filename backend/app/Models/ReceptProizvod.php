<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptProizvod extends Model
{
    /** @use HasFactory<\Database\Factories\ReceptProizvodFactory> */
    use HasFactory;

    protected $primaryKey = 'idReceptProizvod';

    protected $fillable = [
        'idRecept',
        'idProizvod',
        'potrebnaKolicina',
    ];

    public function recept() {
        return $this->belongsTo(Recept::class, 'idRecept');
    }

    public function proizvod() {
        return $this->belongsTo(Proizvod::class, 'idProizvod');
    }

}
