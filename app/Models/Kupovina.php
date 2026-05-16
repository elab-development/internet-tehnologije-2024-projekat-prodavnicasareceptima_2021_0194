<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupovina extends Model
{
    /** @use HasFactory<\Database\Factories\KupovinaFactory> */
    use HasFactory;

    protected $table = 'kupovine';
    protected $primaryKey = 'idKupovine';

    //Jedna kupovina moze imati vise stavki kupovine
    public function kupovinaStavka()  {
        return $this->hasMany(KupovinaStavka::class, 'idKupovine');
    }
}
