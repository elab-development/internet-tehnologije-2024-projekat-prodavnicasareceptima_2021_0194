import React from "react";
import { useNavigate } from "react-router-dom"; // 1. Proveri ovaj import
import useGreeting from "../hooks/useGreeting";
import "../styles/Home.css";

function Home({ token }) {
  const navigate = useNavigate(); // 2. OVO TI JE VEROVATNO NEDOSTAJALO
  const pozdrav = useGreeting();

  return (
    <div className="home-container">
      <div className="hero-section">
        <div className="hero-content">
          <p className="greeting-text">{pozdrav}!</p>
          <h1>Zdravi Zalogaji</h1>
          <p className="hero-description">
            Vaša destinacija za najsvežije namirnice i najukusnije zdrave
            recepte. Kuvajte pametnije, hranite se bolje.
          </p>
          <div className="hero-buttons">
            {/* Ovde se koristi navigate */}
            <button className="btn-main" onClick={() => navigate("/proizvodi")}>
              🛒 Kupite namirnice
            </button>
            <button
              className="btn-outline"
              onClick={() => navigate("/recepti")}
            >
              📖 Pogledaj recepte
            </button>
          </div>
        </div>
      </div>

      <div className="features-grid">
        <div className="feature-card">
          <div className="icon">🌿</div>
          <h3>Sveže namirnice</h3>
          <p>Direktno sa farme na vašu trpezu.</p>
        </div>
        <div className="feature-card">
          <div className="icon">🥗</div>
          <h3>Zdravi Recepti</h3>
          <p>Balansirani obroci za svaki dan.</p>
        </div>
        <div className="feature-card">
          <div className="icon">🚚</div>
          <h3>Brza Dostava</h3>
          <p>Vaša porudžbina stiže u rekordnom roku.</p>
        </div>
      </div>
    </div>
  );
}

export default Home;
