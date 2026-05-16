<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    /** @use HasFactory<\Database\Factories\KorpaFactory> */
    use HasFactory;

    protected $table = 'korpe';
    protected $primaryKey = 'idKorpe';

    //Ova korpa pripada jednom korisniku
    public function korisnik() {
        return $this->belongsTo(Korisnik::class, 'idKorisnika');
    }

    //Jedna korpa moze imati vise stavki korpe
    public function korpaStavka()  {
        return $this->hasMany(KorpaStavka::class, 'idKorpe');
    }
}
