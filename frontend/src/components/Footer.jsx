import React from "react";
import "../styles/Footer.css";

function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="footer">
      <div className="footer-container">
        {/* Leva strana: Opis */}
        <div className="footer-section">
          <h3>Zdravi Zalogaji</h3>
          <p>
            Vaš partner u zdravoj ishrani. Nudimo najbolje namirnice i recepte
            koji menjaju život.
          </p>
        </div>

        {/* Desna strana: Kontakt */}
        <div className="footer-section">
          <h4>Kontakt</h4>
          <p>📍 Zemun, Beograd</p>
          <p>📧 info@zdravizalogaji.rs</p>
          <p>📞 +381 11 123 4567</p>
        </div>
      </div>

      <div className="footer-bottom">
        <p>&copy; {currentYear} Zdravi Zalogaji. Sva prava zadržana.</p>
      </div>
    </footer>
  );
}

export default Footer;
