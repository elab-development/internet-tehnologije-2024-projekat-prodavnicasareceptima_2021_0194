import React, { useEffect, useState } from "react";
import axios from "axios";
import KorpaItem from "../components/KorpaItem";
import "../styles/Korpa.css";

function Korpa() {
  const [korpa, setKorpa] = useState(null);
  const [stavke, setStavke] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  // Stanja za formu i checkout
  const [prikaziFormu, setPrikaziFormu] = useState(false);
  const [formData, setFormData] = useState({
    imeKupca: "",
    prezimeKupca: "",
    emailKupca: "",
    adresaIsporuke: "",
  });

  const token = sessionStorage.getItem("auth_token");

  const fetchKorpa = async () => {
    try {
      const res = await axios.get("/api/korpa", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setKorpa(res.data.korpa);
      setStavke(res.data.stavke);
    } catch (err) {
      setError(err.response?.data?.message || "Greška pri učitavanju korpe");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchKorpa();
  }, []);

  const handleRemove = async (idProizvod) => {
    if (
      !window.confirm(
        "Da li ste sigurni da želite da uklonite ovaj proizvod iz korpe?",
      )
    )
      return;

    try {
      await axios.delete(`/api/korpa/${korpa.idKorpa}/proizvod/${idProizvod}`, {
        headers: { Authorization: `Bearer ${token}` },
      });
      fetchKorpa();
    } catch (err) {
      alert(
        "Greška pri brisanju: " + (err.response?.data?.message || err.message),
      );
    }
  };

  // FUNKCIJA ZA FINALNU KUPOVINU (CHECKOUT)
  const handleFinalnaKupovina = async (e) => {
    e.preventDefault(); // Sprečavamo osvežavanje stranice

    try {
      const res = await axios.post("/api/potvrdi_kupovinu", formData, {
        headers: { Authorization: `Bearer ${token}` },
      });

      alert(res.data.message); // "Uspešno ste izvršili kupovinu!"

      // Resetujemo stanja jer je korpa sada prazna na backendu
      setStavke([]);
      setKorpa(null);
      setPrikaziFormu(false);
    } catch (err) {
      console.error(err);
      alert(
        err.response?.data?.message || "Došlo je do greške prilikom kupovine.",
      );
    }
  };

  const handleInputChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  if (loading)
    return (
      <div className="korpa-container">
        <p className="empty-cart-msg">Učitavanje...</p>
      </div>
    );
  if (error)
    return (
      <div className="korpa-container">
        <p className="empty-cart-msg">{error}</p>
      </div>
    );

  return (
    <div className="korpa-container">
      <h1 className="korpa-title">
        {prikaziFormu ? "Podaci za dostavu" : "Vaša Korpa"}
      </h1>

      <div className="korpa-list">
        {!prikaziFormu ? (
          /* KORAK 1: LISTA STAVKI */
          <>
            {stavke.length === 0 ? (
              <p className="empty-cart-msg">Korpa je trenutno prazna.</p>
            ) : (
              stavke.map((s) => (
                <KorpaItem
                  key={s.idKorpaStavka}
                  s={s}
                  onRemove={handleRemove}
                />
              ))
            )}

            {stavke.length > 0 && (
              <div className="korpa-total">
                <h3>
                  Ukupno za uplatu:{" "}
                  <span style={{ color: "#2d5a27" }}>
                    {korpa?.ukupnaCena} RSD
                  </span>
                </h3>
                <button
                  className="btn btn-success btn-lg mt-3 checkout-btn"
                  onClick={() => setPrikaziFormu(true)}
                >
                  Nastavi na plaćanje
                </button>
              </div>
            )}
          </>
        ) : (
          /* FORMA ZA CHECKOUT */

          <form className="checkout-form" onSubmit={handleFinalnaKupovina}>
            <div className="checkout-summary">
              <h3>
                Ukupno za uplatu: <span>{korpa?.ukupnaCena} RSD</span>
              </h3>
              <p>Pregledajte svoje podatke pre potvrde kupovine.</p>
              <hr />
            </div>
            <div className="form-group">
              <label>Ime</label>
              <input
                type="text"
                name="imeKupca"
                required
                onChange={handleInputChange}
                value={formData.imeKupca}
              />
            </div>
            <div className="form-group">
              <label>Prezime</label>
              <input
                type="text"
                name="prezimeKupca"
                required
                onChange={handleInputChange}
                value={formData.prezimeKupca}
              />
            </div>
            <div className="form-group">
              <label>Email</label>
              <input
                type="email"
                name="emailKupca"
                required
                onChange={handleInputChange}
                value={formData.emailKupca}
              />
            </div>
            <div className="form-group">
              <label>Adresa isporuke</label>
              <textarea
                name="adresaIsporuke"
                required
                onChange={handleInputChange}
                value={formData.adresaIsporuke}
              ></textarea>
            </div>

            <div className="form-buttons">
              <button
                type="button"
                className="btn btn-secondary"
                onClick={() => setPrikaziFormu(false)}
              >
                Nazad na korpu
              </button>
              <button type="submit" className="btn btn-success">
                Potvrdi kupovinu
              </button>
            </div>
          </form>
        )}
      </div>
    </div>
  );
}

export default Korpa;
