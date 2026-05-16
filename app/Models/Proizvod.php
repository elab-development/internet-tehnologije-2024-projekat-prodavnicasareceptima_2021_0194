<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    /** @use HasFactory<\Database\Factories\ProizvodFactory> */
    use HasFactory;

    protected $table = 'proizvodi'; 
    protected $primaryKey = 'idProizvoda';

    //Jedan proizvod moze biti u okviru vise stavki korpe 
    public function korpaStavka()  {
        return $this ->hasMany(KorpaStavka::class, 'idProizvoda');
    }

    //Jedan proizvod moze biti u okviru vise stavki kupovine
    public function kupovinaStavka()  {
        return $this ->hasMany(KupovinaStavka::class, 'idProizvoda');
    }
    
}
