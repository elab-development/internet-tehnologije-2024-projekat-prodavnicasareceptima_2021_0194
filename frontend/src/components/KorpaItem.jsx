import React from "react";

function KorpaItem({ s, onRemove }) {
  const ukupnaCena = s.kolicina * s.proizvod?.cena;

  return (
    <div className="korpa-item">
      {/* Slika */}
      <img
        className="korpa-img"
        src={s.proizvod?.slika || "https://via.placeholder.com/150"}
        alt={s.proizvod?.naziv}
      />

      {/* Info */}
      <div className="korpa-info">
        <h3>{s.proizvod?.naziv}</h3>
        <p>Jedinična cena: {s.proizvod?.cena} RSD</p>
        <p>
          Količina:{" "}
          <b>
            {s.kolicina} {s.proizvod?.mernaJedinica}
          </b>
        </p>
        <p>
          Ukupno: <b>{ukupnaCena} RSD</b>
        </p>
      </div>

      {/* Dugme za brisanje */}
      <button className="remove-btn" onClick={() => onRemove(s.idProizvod)}>
        Ukloni
      </button>
    </div>
  );
}

export default KorpaItem;
