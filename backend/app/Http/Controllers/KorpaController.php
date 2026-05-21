<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use App\Models\KorpaStavka;
use App\Models\Proizvod;
use App\Models\Recept;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Rule;

class KorpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $korpa = Korpa::with('korpaStavka.proizvod')->where('idUser', auth('sanctum')->id())->first();

        if (!$korpa) {
            return response()->json(['message' => 'Korpa je prazna.', 'auth_id' => auth('sanctum')->id()], 404);
        }

        return response()->json(
            [
                //$korpa
                'korpa' => $korpa,
                'stavke' => $korpa->korpaStavka,
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Korpa $korpa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Korpa $korpa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Korpa $korpa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korpa $korpa)
    {
        //
    }

    public function removeKorpaStavka(Request $request, $idKorpa, $idProizvod) 
    {      
        $validator = validator([
            'idKorpa' => $idKorpa,
            'idProizvod' => $idProizvod,
        ], [
            'idKorpa' => ['required', 'integer', Rule::exists('korpas', 'idKorpa')],
            'idProizvod' => ['required', 'integer', Rule::exists('proizvods', 'idProizvod')],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Nevalidan id korpe ili proizvoda',
                'errors' => $validator->errors()
            ], 422);
        }

        $deleted = KorpaStavka::query()->where('idKorpa', $idKorpa)
            ->where('idProizvod', $idProizvod)
            ->delete();

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Stavka ne postoji u korpi.'
            ], 404);
        }

        // update ukupne cene korpe
        $korpa = Korpa::query()->find($idKorpa);

        if ($korpa) {
            $korpa->updateUkupnaCena();
        }

        return response()->json([
            'message' => 'Stavka je obrisana iz korpe.'
        ], 200);
    }

    public function updateOrCreateKorpaStavka(Request $request, $idKorpa, $idProizvod)
    {
        $validator = validator([
            'idKorpa' => $idKorpa,
            'idProizvod' => $idProizvod,
        ], [
            'idKorpa' => ['required', 'integer', Rule::exists('korpas', 'idKorpa')],
            'idProizvod' => ['required', 'integer', Rule::exists('proizvods', 'idProizvod')],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Nevalidan id korpe ili proizvoda',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $request->validate([
        'kolicina' => 'required|integer|min:1'
        ]);
    
        try {
            $cenaProizvoda = Proizvod::findOrFail($idProizvod)->cena;

            // Proveravamo da li stavka već postoji
            $stavka = KorpaStavka::where('idKorpa', $idKorpa)
                                ->where('idProizvod', $idProizvod)
                                ->first();

            if ($stavka) {
                // Ako postoji, DODAJEMO na postojeću količinu
                $stavka->kolicina += $validated['kolicina'];
                $stavka->save();
            } else {
                // Ako ne postoji, kreiramo novu
                $stavka = KorpaStavka::create([
                    'idKorpa' => $idKorpa,
                    'idProizvod' => $idProizvod,
                    'kolicina' => $validated['kolicina'],
                    'cena' => $cenaProizvoda
                ]);
            }

        } catch(\Exception $e) {
            return response()->json(['message' => 'Greška', 'error' => $e->getMessage()], 500);
        }
        
        $korpa = Korpa::find($idKorpa);
        $korpa->updateUkupnaCena();

        return response()->json(['message' => 'Korpa je uspesno azurirana.'], 200);
    }

    //Generise korpu na osnovu recepta
    public function generateCartByRecipe(Request $request, $idRecept)
    {
        //Pronadje recept na osnovu id-a
        $recept = Recept::with('receptProizvod')->find($idRecept);
        if (!$recept) {
            return response()->json(['error' => 'Recept nije pronadjen.'], 404);
        }

        //Kreira listu potrebnih sastojaka za recept
        $sastojci = $recept->receptProizvod->map(function ($receptProizvod) {
            return [
                'idProizvod' => $receptProizvod->idProizvod,
                'naziv' => $receptProizvod->naziv,
                'potrebnaKolicina' => $receptProizvod->pivot->potrebnaKolicina,
                'mernaJedinica' => $receptProizvod->mernaJedinica,
                'cena' => $receptProizvod->cena
            ];
        });

        if ($sastojci->isEmpty()) {
            return response()->json(['error' => 'Nema sastojaka za generisanje korpe.'], 404);
        }
        
        $user = auth('sanctum')->user();
        $korpa = Korpa::findOrFail($user->idUser);

        // $ukupnaCena = 0;
        foreach ($sastojci as $sastojak) {
            KorpaStavka::create([
                'idKorpa' => $korpa->idKorpa,
                'idProizvod' => $sastojak['idProizvod'],
                'kolicina' => $sastojak['potrebnaKolicina'],
                'cena' => $sastojak['cena']   
            ]);
            // $ukupnaCena += $sastojak['cena'] * $sastojak['potrebnaKolicina'];
        }    
        $korpa->updateUkupnaCena();
       
        $korpa->save();
        $korpa->load('korpaStavka');

        return response()->json([
            'message' => 'Korpa za recept id:'.$idRecept.' je generisana.',
            'korpa' => $korpa,       
        ], 200);
    }

}
