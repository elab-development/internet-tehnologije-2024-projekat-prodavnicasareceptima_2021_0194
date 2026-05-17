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
    public function update(Request $request, Proizvod $proizvod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proizvod $proizvod)
    {
        //
    }
}
