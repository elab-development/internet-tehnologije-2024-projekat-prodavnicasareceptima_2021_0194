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
        
        if ($validator->fails())
            return response()->json($validator->errors(), 422); 
        
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

        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]); 
    }

    public function login(Request $request) 
    { 
        if (!Auth::attempt([
            'korisnickoIme' => $request->korisnickoIme,
            'password' => $request->lozinka,
        ])) {
            return response()->json([
                'message' => 'Neispravno korisničko ime ili lozinka.'
            ], 401);
        }
        
        $user = User::firstWhere('korisnickoIme', $request['korisnickoIme']); 
        
        $token = $user->createToken('auth_token')->plainTextToken; 
        
        return response() ->json([
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
    }
}
