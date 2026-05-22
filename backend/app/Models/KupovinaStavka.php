<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KupovinaStavka extends Model
{
    /** @use HasFactory<\Database\Factories\KupovinaStavkaFactory> */
    use HasFactory;

    protected $primaryKey = 'idKupovinaStavka';

    protected $fillable = [
        'idKupovina',
        'idProizvod',
        'kolicina',
        'cena',
        ];

    //Jedna stavka kupovine pripada jednoj kupovini
    public function kupovina(){
        return $this->belongsTo(Kupovina::class,'idKupovina');
    }

    //Jedna stavka kupovine odnosi se na jedan proizvod
    public function proizvod()  {
        return $this->belongsTo(Proizvod::class, 'idProizvod');
    }

}
