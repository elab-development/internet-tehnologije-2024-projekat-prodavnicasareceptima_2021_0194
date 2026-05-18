<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use  Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use  HasApiTokens, HasFactory, Notifiable;

   // protected $table = 'korisnici'; // Naziv tabele u bazi
    protected $primaryKey = 'idUser'; // Primarni ključ u bazi

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'korisnickoIme',
        'lozinka',
        'tipKorisnika'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'lozinka',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Jedan korisnik moze imati vise korpi
    public function korpa()  {
        return $this->hasMany(Korpa::class, 'idUser');
    }

    public function getAuthPassword()
    {
        return $this->lozinka; //lozinka se u bazi zove lozinka, a ne password
    }

    /*public function username()
    {
        return 'korisnickoIme';
    }*/

}
