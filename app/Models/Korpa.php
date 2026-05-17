<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    /** @use HasFactory<\Database\Factories\KorpaFactory> */
    use HasFactory;

    protected $primaryKey = 'idKorpa';

    protected $fillable = [ 
        'idKorisnik',
        'datumKreiranja',
        'ukupnaCena'
    ];

    //Ova korpa pripada jednom korisniku
    public function user() {
        return $this->belongsTo(User::class, 'idUser');
    }

    //Jedna korpa moze imati vise stavki korpe
    public function korpaStavka()  {
        return $this->hasMany(KorpaStavka::class, 'idKorpa');
    }
}
