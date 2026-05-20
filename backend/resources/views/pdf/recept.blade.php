<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $recept->naziv }}</title>
    <style>
        body { font-family: sans-serif; }
        .naslov { text-align: center; color: #2d5a27; }
        .sekcija { margin-top: 20px; border-bottom: 1px solid #ccc; }
        .sastojak { font-style: italic; }
    </style>
</head>
<body>
    <h1 class="naslov">{{ $recept->naziv }}</h1>
    <p><strong>Kategorija:</strong> {{ $recept->kategorija }} | <strong>Vreme:</strong> {{ $recept->vremePripreme }} min</p>

    <div class="sekcija">
        <h3>Potrebni sastojci:</h3>
        <ul>
            @foreach($recept->receptProizvod as $proizvod)
                <li>
                    <span class="sastojak">{{ $proizvod->naziv }}</span> 
                    - {{ $proizvod->pivot->potrebnaKolicina }} {{ $proizvod->mernaJedinica }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="sekcija">
        <h3>Uputstvo za pripremu:</h3>
        <p>{{ $recept->uputstvo }}</p>
    </div>
</body>
</html>