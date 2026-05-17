<?php

namespace App\Http\Controllers;

use App\Models\Proizvod;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProizvodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proizvodi=Proizvod::all();
        return response()->json($proizvodi);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'cena' => 'required|numeric|min:0',
            'kategorija' => 'required|string|max:255',
            'mernaJedinica'=> 'required|string|max:255',
            //'slika' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        //Kreiranje proizvoda
        $proizvod = Proizvod::create([
            'naziv' => $validated['naziv'],
            'cena' => $validated['cena'],
            'kategorija' =>$validated['kategorija'],
            'mernaJedinica' =>$validated['mernaJedinica']
        ]);
  
        return response()->json([
            'message' => 'Proizvod je uspesno kreiran',
            'data' => $proizvod
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proizvod $proizvod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proizvod $proizvod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idProizvod)
    {
        //Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'string|max:255',
            'cena' => 'numeric|min:0',
            'kategorija' => 'string|max:255',
            'mernaJedinica'=> 'string|max:255',
            //'slika' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        //Nalazenje proizvoda po id-u
        $proizvod = Proizvod::findOrFail($idProizvod);

        //Azuriranje proizvoda
        $proizvod->update($validated);
  
        return response()->json([
            'message' => 'Proizvod je uspesno azuriran.',
            'data' => $proizvod
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idProizvod)
    {
        //Nalazenje proizvoda po id-u
        $proizvod = Proizvod::findOrFail($idProizvod);

        //Brisanje proizvoda
        $proizvod->delete();
  
        return response()->json([
            'message' => 'Proizvod je uspesno obrisan.'
        ], 200);
    }

    //Pretrazivanje proizvoda po nazivu i kategoriji
    public function search(Request $request)
    {
        //Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'nullable|string|max:255',
            'kategorija' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        $query = Proizvod::query();

        if (!empty($validated['naziv'])) {
            $query->where('naziv', 'like', '%' . $validated['naziv'] . '%');
        }
        if (!empty($validated['kategorija'])) {
            $query->where('kategorija', 'like', '%' . $validated['kategorija'] . '%');
        }
        
        $proizvodi = $query->get();
        if ($proizvodi->isEmpty()) {
            return response()->json([
                'message' => 'Proizvod nije pronadjen.',
            ], 404);
        }
  
        return response()->json([
            'data' => $proizvodi
        ], 200);
    }
}
