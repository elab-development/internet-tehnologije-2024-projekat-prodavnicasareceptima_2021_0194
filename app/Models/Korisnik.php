<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    /** @use HasFactory<\Database\Factories\KorisnikFactory> */
    use HasFactory;

    protected $table = 'korisnici'; // Naziv tabele u bazi
    protected $primaryKey = 'idKorisnika'; // Primarni ključ u bazi

    //Jedan korisnik moze imati vise korpi
    public function korpa()  {
        return $this->hasMany(Korpa::class, 'idKorisnika');
    }
}
