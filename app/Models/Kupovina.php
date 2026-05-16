<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupovina extends Model
{
    /** @use HasFactory<\Database\Factories\KupovinaFactory> */
    use HasFactory;

    protected $primaryKey = 'idKupovina';

    protected $fillable = [
        'imeKupca',
        'prezimeKupca',
        'emailKupca',
        'adresaIsporuke',
        'datumKupovine',
        'ukupnaCena'
    ];

    //Jedna kupovina moze imati vise stavki kupovine
    public function kupovinaStavka()  {
        return $this->hasMany(KupovinaStavka::class, 'idKupovina');
    }
}
