import React from "react";
import { useNavigate } from "react-router-dom";
import "../styles/Recepti.css"; // Napravićemo poseban CSS za recepte

function ReceptItem({
  id,
  slika,
  naziv,
  vreme,
  kalorije,
  porcije,
  kategorija,
}) {
  const navigate = useNavigate();

  return (
    <div className="recept-blog-card">
      <div className="recept-image-container">
        <img src={slika || "https://via.placeholder.com/400x300"} alt={naziv} />
        <span className="recept-category-badge">{kategorija}</span>
      </div>

      <div className="recept-content">
        <h2 className="recept-title">{naziv}</h2>

        <div className="recept-meta">
          <div className="meta-item">
            ⏱ <span>{vreme} min</span>
          </div>
          <div className="meta-item">
            🔥 <span>{kalorije} kcal</span>
          </div>
          <div className="meta-item">
            👥 <span>{porcije} porcije</span>
          </div>
        </div>

        <p className="recept-description">
          Otkrijte kako da pripremite ovo ukusno jelo iz kategorije{" "}
          {kategorija.toLowerCase()}. Savršeno izbalansiran obrok spreman za
          samo {vreme} minuta.
        </p>

        <button
          className="btn-pregled"
          onClick={() => navigate(`/recepti/${id}`)}
        >
          Pogledaj recept
        </button>
      </div>
    </div>
  );
}

export default ReceptItem;
