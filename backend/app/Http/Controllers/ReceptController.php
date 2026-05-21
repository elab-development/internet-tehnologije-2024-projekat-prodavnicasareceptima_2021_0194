<?php

namespace App\Http\Controllers;

use App\Models\Recept;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $recepti = Recept::with('receptProizvod')->paginate(5);
	
	    return response()->json([
            'message' => 'Recepti su uspesno ucitani.',
            'data' => $recepti
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
        //Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'uputstvo' => 'required|string',
            'kategorija' => 'required|string|max:255',
            'vremePripreme'=> 'required|integer|min:1',
            'brojKalorija'=> 'required|integer|min:0',
            'brojPorcija' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        //Kreiranje recepta
        $recept = Recept::create([
            'naziv' => $validated['naziv'],
            'uputstvo' => $validated['uputstvo'],
            'kategorija' => $validated['kategorija'],
            'vremePripreme' => $validated['vremePripreme'],
            'brojKalorija' => $validated['brojKalorija'],
            'brojPorcija' => $validated['brojPorcija']
        ]);

        return response()->json([
            'message' => 'Recept je uspesno kreiran',
            'data' => $recept
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($idRecept)
    {
        //$recept = Recept::findOrFail($idRecept);
        $recept = Recept::with('receptProizvod')->findOrFail($idRecept);
        //$recept = Recept::with('receptProizvod')->findOrFail($idRecept);
        //return new ReceptResource($recept);

        return response()->json([
            'message' => 'Recept je uspesno ucitan.',
            'data' => $recept
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recept $recept)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idRecept)
    {
        //Validacija podataka
        $validator = Validator::make($request->all(), [
            'naziv' => 'string|max:255',
            'uputstvo' => 'string',
            'kategorija' => 'string|max:255',
            'vremePripreme'=> 'integer|min:1',
            'brojKalorija'=> 'integer|min:0',
            'brojPorcija' => 'integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
       
        $validated = $validator->validated();

        //Nalazenje recepta po id-u
        $recept = Recept::findOrFail($idRecept);

        //Azuriranje recepta
        $recept->update($validated);
  
        return response()->json([
            'message' => 'Recept je uspesno azuriran.',
            'data' => $recept
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idRecept)
    {
        //Nalazenje recepta po id-u
        $recept = Recept::findOrFail($idRecept);

        //Brisanje recepta
        $recept->delete();
  
        return response()->json([
            'message' => 'Recept je uspesno obrisan.'
        ], 200);
    }

    //Pretrazivanje proizvoda po sastojcima
    public function searchByIngredients(Request $request)
    {
        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'sastojci' => 'nullable|array',
            'sastojci.*' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validated();
        $sastojci = $validated['sastojci'];

        $recepti = Recept::whereHas('receptProizvod', function ($query) use ($sastojci) {
            $query->whereIn('proizvods.naziv', $sastojci);
        })->with(['receptProizvod' => function ($query) {
            $query->select('proizvods.naziv', 'proizvods.mernaJedinica');
        }])->get();

        return response()->json([
            'data' => $recepti
        ], 200);
    }

    public function exportPdf($idRecept)
    {
         //Pronadje recept sa svim njegovim sastojcima
        $recept = Recept::with('receptProizvod')->find($idRecept);

        if (!$recept) {
            return response()->json(['message' => 'Recept nije pronadjen.'], 404);
        }

        //Ucita Blade fajl i prosledi mu podatke
        $pdf = Pdf::loadView('pdf.recept', compact('recept'));

        //Vrati PDF kao fajl za preuzimanje
        //download() ce naterati browser da preuzme fajl, stream() bi ga otvorio u tabu
        return $pdf->download('recept-' . $idRecept . '.pdf');
    }

    public function search(Request $request)
    {
        $query = Recept::with('receptProizvod');

        // Filter po kategoriji
        if ($request->filled('kategorija')) {
            $query->where('kategorija', $request->kategorija);
        }

        // Filter po vremenu pripreme
        if ($request->filled('vremePripreme')) {
            $vreme = $request->vremePripreme;
            if ($vreme == 'do_30') $query->where('vremePripreme', '<=', 30);
            elseif ($vreme == '30_60') $query->whereBetween('vremePripreme', [30, 60]);
            elseif ($vreme == 'preko_60') $query->where('vremePripreme', '>', 60);
        }

        $recepti = $query->paginate(10);

        return response()->json([
            'message' => 'Pretraga uspešna.',
            'data' => $recepti
        ], 200);
    }
}
