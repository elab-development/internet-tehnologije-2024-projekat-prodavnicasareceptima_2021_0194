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
        $proizvodi=Proizvod::query()->paginate(10);
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
            'slika' => 'nullable|url'
            //'slika' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // LOGIKA ZA SLIKU
        /*$path = null;
        if ($request->hasFile('slika')) {
            // Čuva sliku u folderu storage/app/public/proizvodi
            $path = $request->file('slika')->store('proizvodi', 'public');
        }*/
       
        $validated = $validator->validated();

        //Kreiranje proizvoda
        $proizvod = Proizvod::create([
            'naziv' => $validated['naziv'],
            'cena' => $validated['cena'],
            'kategorija' =>$validated['kategorija'],
            'mernaJedinica' =>$validated['mernaJedinica'],
            'slika' => $validated['slika'] // Ovde upisujemo putanju (npr. "proizvodi/abc.jpg")
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
            'slika' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        //Nalazenje proizvoda po id-u
        $proizvod = Proizvod::findOrFail($idProizvod);

        /*$data = $request->only(['naziv', 'cena', 'kategorija', 'mernaJedinica']);

        if ($request->hasFile('slika')) {
            // Čuvamo novu sliku
            $path = $request->file('slika')->store('proizvodi', 'public');
            $data['slika'] = $path;
        }*/

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

        //Ako unesemo oba, vratice proizvod koji zadovoljava oba uslova
        if (!empty($validated['naziv'])) {
            $query->where('naziv', 'like', '%' . $validated['naziv'] . '%');
        }
        if (!empty($validated['kategorija'])) {
            $query->where('kategorija', 'like', '%' . $validated['kategorija'] . '%');
        }
        
        //$proizvodi = $query->get();
        $proizvodi = $query->paginate(10);
        if ($proizvodi->isEmpty()) {
            return response()->json([
                'message' => 'Proizvod nije pronadjen.',
            ], 404);
        }
  
        return response()->json([
            'data' => $proizvodi
        ], 200);
    }

    public function allNames()
    {
        $proizvodi = Proizvod::select('idProizvod', 'naziv')->get();
        return response()->json($proizvodi);
    }
}
