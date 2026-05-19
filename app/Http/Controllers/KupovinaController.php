<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use App\Models\KorpaStavka;
use App\Models\Kupovina;
use App\Models\KupovinaStavka;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KupovinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kupovine = Kupovina::all();
        return response()->json($kupovine);
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
        $validator = Validator::make($request->all(), [
            'imeKupca' => 'required|string',//|exists:users,id'
            'prezimeKupca' => 'required|string',
            'ukupnaCena' => 'required|numeric',
            'emailKupca' => 'required|email',
            'adresaIsporuke'=> 'required|string',
            'datumKupovine' => 'required|date'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $kupovina = Kupovina::create($validator->validated());

        return response()->json([
            'message' => 'Kupovina je uspesno kreirana',
            'data' => $kupovina
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($idKupovina)
    {
        $kupovina = Kupovina::findOrFail($idKupovina);
        return response()->json($kupovina);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kupovina $kupovina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idKupovina)
    {
        $kupovina = Kupovina::findOrFail($idKupovina);

        $validator = Validator::make($request->all(), [
            'imeKupca' => 'require|string',//|exists:users,id'
            'prezimeKupca' => 'required|string',
            'ukupnaCena' => 'required|numeric',
            'emailKupca' => 'required|email',
            'adresaIsporuke'=> 'required|string',
            'datumKupovine' => 'required|date'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $kupovina -> update($validator->validated());

        return response()->json([
            'message' => 'Kupovina je uspesno azurirana.',
            'data' => $kupovina
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idKupovina)
    {
        $kupovina = Kupovina::findOrFail($idKupovina);
        $kupovina->delete();

        return response()->json(['message' => 'Kupovina obrisana'], 200);
    }

    public function checkout(Request $request)
    {
        //Trazimo korpu koja pripada ulogovanom korisniku
        $korpa = Korpa::query()->where('idUser', auth('sanctum')->id())->first();
        
        if (!$korpa || $korpa->korpaStavka->isEmpty()) {
            return response()->json(['message' => 'Vasa korpa je prazna.'], 400);
        }

        //Validacija podataka za dostavu, uzimamo ono sto je korisnik ukucao
        $validated = $request->validate([
            'imeKupca' => 'required|string',
            'prezimeKupca' => 'required|string',
            'emailKupca' => 'required|email',
            'adresaIsporuke' => 'required|string',
        ]);

        //Pocetak transakcije
        //Ako bilo koja linija ispod "pukne", baza ce se vratiti u prethodno stanje
        DB::beginTransaction();

        try {
            //Kreiranje nove kupovine
            $kupovina = Kupovina::create([
                //'idUser' => idUser,
                'imeKupca' => $validated['imeKupca'],
                'prezimeKupca' => $validated['prezimeKupca'],
                'emailKupca' => $validated['emailKupca'],
                'adresaIsporuke' => $validated['adresaIsporuke'],
                'datumKupovine' => now(),
                'ukupnaCena' => $korpa->ukupnaCena,
            ]);

            //Dodavanje stavki u kupovinu
            //Za svaku stavku iz korpe, pravimo novi red u tabeli kupovina_stavkas
            foreach ($korpa->korpaStavka as $stavka) {
                KupovinaStavka::create([
                    'idKupovina' => $kupovina->idKupovina,
                    'idProizvod' => $stavka->idProizvod,
                    'kolicina' => $stavka->kolicina,
                    'cena' => $stavka->cena,
                ]);
            }

            //Brisanje stavki iz korpe nakon uspešne kupovine
            //KorpaStavka::query()->where('idKorpa', $korpa->idKorpa)->delete();
            $korpa->korpaStavka()->delete();

            //Azuriranje statusa korpe
            $korpa->updateUkupnaCena();

            //Potvrda transakcije
            DB::commit();

            $kupovina->save();
            $kupovina->load('kupovinaStavka');
            return response()->json([
                'message' => 'Uspesno ste izvrsili kupovinu!',
                'kupovina' => $kupovina
            ], 200);
        } catch (\Exception $e) {
            //Rollback u slucaju greske
            //Ako se desi bilo kakva greska vracamo sve na staro - korpa ostaje puna, kupovina se brise
            DB::rollBack();
            return response()->json([
                'message' => 'Greska prilikom obrade kupovine. Molimo pokusajte ponovo.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
