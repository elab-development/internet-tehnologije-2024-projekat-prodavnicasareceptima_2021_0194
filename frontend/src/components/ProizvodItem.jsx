import React, { useState } from "react";

function ProizvodItem({ id, image, naziv, cena, jedinica, onAddToCart }) {
  // Stanje sada dozvoljava i prazan string kako bi brisanje radilo
  const [kolicina, setKolicina] = useState(1);

  const handleInputChange = (e) => {
    const vrednost = e.target.value;
    // Dozvoljavamo prazan string ili samo brojeve
    if (vrednost === "") {
      setKolicina("");
    } else {
      const num = parseInt(vrednost);
      if (num > 0) setKolicina(num);
    }
  };

  return (
    <div className="menuItem">
      <img src={image || "https://via.placeholder.com/300"} alt={naziv} />
      <h1>{naziv}</h1>
      <h3>{cena} RSD</h3>

      <div
        className="quantity-control"
        style={{
          marginBottom: "15px",
          display: "flex",
          alignItems: "center",
          gap: "8px",
        }}
      >
        <label>Količina:</label>
        <input
          type="number"
          min="1"
          value={kolicina}
          onChange={handleInputChange}
          style={{
            width: "60px",
            padding: "5px",
            borderRadius: "5px",
            border: "1px solid #ccc",
          }}
        />
        <span style={{ color: "#666", fontWeight: "500" }}>{jedinica}</span>
      </div>

      <button
        onClick={() => {
          // Ako je polje prazno, šaljemo 1, inače šaljemo upisanu količinu
          const finalnaKolicina = kolicina === "" ? 1 : kolicina;
          onAddToCart(id, finalnaKolicina);
          setKolicina(1); // Resetujemo na 1 nakon dodavanja
        }}
      >
        Dodaj u korpu
      </button>
    </div>
  );
}

export default ProizvodItem;
