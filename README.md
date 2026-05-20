# 🥗 Veb prodavnica sa receptima

Veb platforma koja objedinjuje online prodavnicu zdravih proizvoda i bazu recepata. Korisnicima omogućava lako pretraživanje recepata, dodavanje sastojaka i proizvoda u korpu na osnovu izabranog recepta, kao i pretraživanje recepata na osnovu unetih sastojaka. Pored toga, korisnici mogu sačuvati recepte u PDF formatu. Cilj je da se korisnicima olakša planiranje obroka i omogući kupovina proizvoda na jednom mestu.

## 🛠 Tehnologije
- **Backend:** Laravel (PHP)
- **Frontend:** React.js (JavaScript)

## 📁 Struktura projekta
- `/backend` - Laravel API aplikacija
- `/frontend` - React klijentska aplikacija

## 🚀 Kako pokrenuti aplikaciju?

### 1. Podešavanje Backenda
1. Ući u `backend` folder
2. Odraditi `composer install`
3. Iskopirati `.env.example` u `.env` i podesiti bazu
4. `php artisan key:generate`
5. `php artisan db:seed` (da napunite bazu podacima)
6. `php artisan serve`

### 2. Podešavanje Frontenda
1. Ući u `frontend` folder
2. `npm install`
3. `npm start`
