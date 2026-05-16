<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    /** @use HasFactory<\Database\Factories\ProizvodFactory> */
    use HasFactory;

    protected $primaryKey = 'idProizvod';

    protected $fillable = [
        'naziv',
        'cena',
        'kategorija',
        'mernaJedinica',
        'slika',
    ];

    //Jedan proizvod moze biti u okviru vise stavki korpe 
    public function korpaStavka()  {
        return $this ->hasMany(KorpaStavka::class, 'idProizvod');
    }

    //Jedan proizvod moze biti u okviru vise stavki kupovine
    public function kupovinaStavka()  {
        return $this ->hasMany(KupovinaStavka::class, 'idProizvod');
    }
    
    public function receptProizvod() {
        return $this->belongsToMany(Recept::class, 'recept_proizvods', 'idProizvod', 'idRecept')->withPivot('potrebnaKolicina');
    }

}
