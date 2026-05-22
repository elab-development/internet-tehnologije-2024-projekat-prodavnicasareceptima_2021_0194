<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorpaStavka extends Model
{
    /** @use HasFactory<\Database\Factories\KorpaStavkaFactory> */
    use HasFactory;
    
    protected $primaryKey = 'idKorpaStavka';

    protected $fillable = [ 
        'idProizvod',
        'idKorpa',
        'kolicina',
        'cena'
    ];

    //Jedna stavka korpe pripada jednoj korpi
    public function korpa() {
        return $this->belongsTo(Korpa::class, 'idKorpa');
    }

    //Jedan stavka korpe odnosi se na jedan proizvod 
    public function proizvod() {
        return $this->belongsTo(Proizvod::class, 'idProizvod');
    }
}
