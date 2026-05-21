import React from "react";

function ProizvodItem({ image, naziv, cena, onAddToCart }) {
  return (
    <div className="menuItem">
      <img src={image || "https://via.placeholder.com/300"} alt={naziv} />

      <h1>{naziv}</h1>
      <h3>{cena} RSD</h3>

      <button onClick={onAddToCart}>Dodaj u korpu</button>
    </div>
  );
}

export default ProizvodItem;
