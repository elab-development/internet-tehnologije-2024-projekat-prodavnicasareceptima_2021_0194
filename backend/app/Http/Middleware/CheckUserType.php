<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $tipKorisnika): Response
    {
        //Provera: Da li je korisnik uopšte ulogovan?
        if (!$request->user()) {
            return response()->json(['message' => 'Niste ulogovani.'], 401);
        }

        //Da li se tipKorisnika iz baze nalazi u nizu dozvoljenih uloga ($types)?
        //Ako je korisnik 'registrovani', a ruta traži samo 'admin', on ovde pada.
        if ($request->user()->tipKorisnika != $tipKorisnika) {
            return response()->json([
                'message' => 'Pristup zabranjen. Vaša uloga (' . $request->user()->tipKorisnika . ') nema ovlascenje za ovu operaciju.'
            ], 403);
        }
        // Ako su svi uslovi ispunjeni, pusti ga na kontroler
        return $next($request);
    }
}
