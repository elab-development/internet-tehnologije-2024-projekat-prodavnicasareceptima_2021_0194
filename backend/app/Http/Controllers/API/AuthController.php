<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Korpa;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator; 

class AuthController extends Controller
{
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'korisnickoIme' => 'required|string|max:255|unique:users',
            'lozinka' => 'required|string|min:8',
            'tipKorisnika' => 'string|in:admin,registrovani,anonimni'
        ]); 
        
        if ($validator->fails()) {
            $msg = $validator->errors()->first();

            $map = [
                'The korisnicko ime field is required.' => 'Korisničko ime je obavezno.',
                'The korisnicko ime has already been taken.' => 'Korisničko ime već postoji.',
                'The lozinka field is required.' => 'Lozinka je obavezna.',
                'The lozinka field must be at least 8 characters.' => 'Lozinka mora imati minimum 8 karaktera.',
            ];

            return response()->json([
                'success' => false,
                'message' => $map[$msg] ?? 'Neispravni podaci za registraciju'
            ]);
        }
        
        $user = User::create([ 
            'korisnickoIme' => $request->korisnickoIme,
            'lozinka' => Hash::make($request->lozinka),
            'tipKorisnika' => 'registrovani'
        ]); 

        //KREIRANJE PRAZNE KORPE
        Korpa::create([
            'idUser' => $user->idUser,      
            'datumKreiranja' => now(),      
            'ukupnaCena' => 0              
        ]);

        $token = $user->createToken('auth_token')->plainTextToken; 

        return response()->json(['success'=>true, 'data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]); 
    }

    public function login(Request $request) 
    { 
        if (!Auth::attempt([
            'korisnickoIme' => $request->korisnickoIme,
            'password' => $request->lozinka,
        ])) {
            return response()->json([
                'success' => false
            ]);
        }
        
        $user = User::firstWhere('korisnickoIme', $request['korisnickoIme']); 
        
        $token = $user->createToken('auth_token')->plainTextToken; 
        
        return response() ->json([
            'success' => true,
            'message' => 'Hi ' . $user->korisnickoIme . ', welcome to home', 
            'access_token' => $token, 
            'token_type' => 'Bearer',
        ]); 
    }

    public function logout()
    {
        //auth()->users()->tokens()->delete();
        auth('sanctum')->user()->tokens()->delete();
        //Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Uspešno ste se odjavili.']);

        // Prvo proveravamo da li korisnik ima validan token
        /*$user = Auth::user();
        if ($user) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            // Uspesno odjavljivanje
            return response()->json([
                'message' => 'Uspešno ste se odjavili.'
            ]);
        }
        // Ako korisnik nije prijavljen
        return response()->json([
            'message' => 'Korisnik nije prijavljen.'
        ], 401);*/
    }
}
