import React, { useState, useEffect } from "react";
import axios from "axios";
import ReceptItem from "../components/ReceptItem";
import "../styles/MojiSastojci.css";

function MojiSastojci() {
  const [sviProizvodi, setSviProizvodi] = useState([]);
  const [unos, setUnos] = useState("");
  const [izabraniSastojci, setIzabraniSastojci] = useState([]);
  const [pronadjeniRecepti, setPronadjeniRecepti] = useState([]);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    // Sada zovemo novu rutu koja nam daje APSOLUTNO SVE proizvode
    axios.get("http://127.0.0.1:8000/api/proizvodi/all").then((res) => {
      // Pošto ovde nema paginacije, podaci su direktno u res.data
      setSviProizvodi(res.data);
    });
  }, []);

  // 2. Filtriranje predloga dok korisnik kuca
  const predlozi = sviProizvodi.filter(
    (p) =>
      p.naziv.toLowerCase().includes(unos.toLowerCase()) &&
      !izabraniSastojci.includes(p.naziv) &&
      unos.length > 1, // Prikazuj predloge tek nakon 2 ukucana slova
  );

  const dodajSastojak = (naziv) => {
    if (!izabraniSastojci.includes(naziv)) {
      setIzabraniSastojci([...izabraniSastojci, naziv]);
    }
    setUnos("");
  };

  const ukloniSastojak = (naziv) => {
    setIzabraniSastojci(izabraniSastojci.filter((i) => i !== naziv));
  };

  // 3. Glavni poziv API-ja za pretragu recepata po sastojcima
  const pretraziRecepte = () => {
    if (izabraniSastojci.length === 0) return;
    setLoading(true);
    axios
      .get("http://127.0.0.1:8000/api/pretraga_po_sastojcima", {
        params: { sastojci: izabraniSastojci },
      })
      .then((res) => {
        // Pristupamo nizu recepata (Laravel vraća ['data' => $recepti])
        setPronadjeniRecepti(res.data.data || []);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
      });
  };

  return (
    <div className="sastojci-page-new">
      <div className="search-hero-section">
        <h1>Kuvajte sa onim što imate</h1>
        <p>
          Unesite sastojke iz vašeg frižidera, a mi ćemo naći recept za vas.
        </p>

        <div className="search-wrapper">
          <div className="input-group-custom">
            <input
              type="text"
              placeholder="Npr. Jaja, Med, Banana..."
              value={unos}
              onChange={(e) => setUnos(e.target.value)}
            />
            {predlozi.length > 0 && (
              <ul className="suggestions-list">
                {predlozi.map((p) => (
                  <li key={p.idProizvod} onClick={() => dodajSastojak(p.naziv)}>
                    {p.naziv}
                  </li>
                ))}
              </ul>
            )}
          </div>
          <button className="btn-go" onClick={pretraziRecepte}>
            Pronađi recepte
          </button>
        </div>

        <div className="selected-tags">
          {izabraniSastojci.map((s) => (
            <span key={s} className="ingredient-tag">
              {s} <button onClick={() => ukloniSastojak(s)}>&times;</button>
            </span>
          ))}
        </div>
      </div>

      {/* REZULTATI PRETRAGE */}
      <div className="results-section">
        {loading ? (
          <div className="text-center mt-5">
            <h3>Tražim recepte...</h3>
          </div>
        ) : (
          <div className="recepti-blog-list">
            {pronadjeniRecepti.map((r) => (
              <ReceptItem
                key={r.idRecept}
                id={r.idRecept} // Ovaj ID je ključan za otvaranje detalja
                slika={r.slika}
                naziv={r.naziv}
                vreme={r.vremePripreme}
                kalorije={r.brojKalorija}
                porcije={r.brojPorcija}
                kategorija={r.kategorija}
              />
            ))}
          </div>
        )}
        {!loading &&
          izabraniSastojci.length > 0 &&
          pronadjeniRecepti.length === 0 && (
            <p className="no-results-msg">
              Nismo pronašli recepte sa izabranim sastojcima. Pokušajte sa nekom
              drugom kombinacijom.
            </p>
          )}
      </div>
    </div>
  );
}

export default MojiSastojci;
