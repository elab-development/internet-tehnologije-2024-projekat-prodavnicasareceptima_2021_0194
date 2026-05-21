import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import "../styles/ReceptDetalji.css";

function ReceptDetalji() {
  const { id } = useParams(); // Preuzima ID iz URL-a
  const navigate = useNavigate();
  const [recept, setRecept] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Pozivamo tvoj Laravel API za jedan recept
    axios
      .get(`http://127.0.0.1:8000/api/recepti/${id}`)
      .then((res) => {
        console.log("Šta je stiglo iz baze:", res.data.data);
        // Pristupamo podacima (res.data.data zbog API Resource-a)
        setRecept(res.data.data || res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Greška pri učitavanju recepta:", err);
        setLoading(false);
      });
  }, [id]);

  if (loading)
    return <div className="loading-state">Učitavanje recepta...</div>;
  if (!recept)
    return <div className="loading-state">Recept nije pronađen.</div>;

  return (
    <div className="detalji-container">
      <button className="btn-back" onClick={() => navigate(-1)}>
        &larr; Povratak na recepte
      </button>

      <div className="recept-header">
        <div className="recept-slika-okvir">
          <img src={recept.slika} alt={recept.naziv} />
        </div>
        <div className="recept-osnovno">
          <span className="kategorija-label">{recept.kategorija}</span>
          <h1>{recept.naziv}</h1>
          <div className="meta-info">
            <span>⏱ {recept.vremePripreme} min</span>
            <span>🔥 {recept.brojKalorija} kcal</span>
            <span>👥 {recept.brojPorcija} porcije</span>
          </div>
        </div>
      </div>

      <div className="recept-sadrzaj">
        {/* SEKCIJA SA SASTOJCIMA */}
        <div className="sastojci-blok">
          <h3>Potrebni sastojci</h3>
          <ul className="sastojci-lista">
            {/* Koristimo TAČAN NAZIV IZ KONZOLE: recept_proizvod */}
            {recept.recept_proizvod &&
              recept.recept_proizvod.map((stavka, index) => (
                <li key={index} className="sastojak-red">
                  <span className="kolicina">
                    {/* Količina se nalazi u pod-objektu pivot! */}
                    {stavka.pivot?.potrebnaKolicina} {stavka.mernaJedinica}
                  </span>
                  <span className="ime-proizvoda">{stavka.naziv}</span>
                </li>
              ))}
          </ul>
        </div>

        {/* SEKCIJA SA UPUTSTVOM */}
        <div className="uputstvo-blok">
          <h3>Način pripreme</h3>
          <p className="uputstvo-tekst">{recept.uputstvo}</p>
        </div>
      </div>
    </div>
  );
}

export default ReceptDetalji;
