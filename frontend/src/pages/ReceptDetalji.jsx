import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import "../styles/ReceptDetalji.css";

function ReceptDetalji() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [recept, setRecept] = useState(null);
  const [loading, setLoading] = useState(true);
  const [exporting, setExporting] = useState(false);
  const [generatingCart, setGeneratingCart] = useState(false); // Novo stanje

  useEffect(() => {
    axios
      .get(`http://127.0.0.1:8000/api/recepti/${id}`)
      .then((res) => {
        setRecept(res.data.data || res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Greška pri učitavanju recepta:", err);
        setLoading(false);
      });
  }, [id]);

  const handleExportPdf = async () => {
    setExporting(true);
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/recepti/${id}/export-pdf`,
        { responseType: "blob" },
      );
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", `recept-${id}.pdf`);
      document.body.appendChild(link);
      link.click();
      link.remove();
    } catch (error) {
      alert("Greška prilikom generisanja PDF-a.");
    } finally {
      setExporting(false);
    }
  };

  // NOVA FUNKCIJA ZA KORPU
  const handleGenerateCart = async () => {
    const token = sessionStorage.getItem("auth_token");
    if (!token) {
      alert("Morate biti ulogovani da biste generisali korpu!");
      return;
    }

    setGeneratingCart(true);
    try {
      const res = await axios.post(
        `http://127.0.0.1:8000/api/generisi_korpu/${id}`,
        {},
        {
          headers: { Authorization: `Bearer ${token}` },
        },
      );
      alert(res.data.message);
      navigate("/korpa"); // Opciono: preusmeri korisnika u korpu da vidi sastojke
    } catch (err) {
      console.error(err);
      alert(err.response?.data?.error || "Greška pri generisanju korpe.");
    } finally {
      setGeneratingCart(false);
    }
  };

  if (loading)
    return <div className="loading-container">Učitavanje recepta...</div>;
  if (!recept)
    return <div className="loading-container">Recept nije pronađen.</div>;

  return (
    <div className="detalji-page-wrapper">
      <div className="detalji-container">
        <div className="top-navigation">
          <button className="btn-back" onClick={() => navigate(-1)}>
            &larr; Nazad
          </button>

          <div className="action-buttons">
            <button
              className="btn-pdf"
              onClick={handleExportPdf}
              disabled={exporting}
            >
              {exporting ? "..." : "📄 PDF"}
            </button>

            <button
              className="btn-cart-generate"
              onClick={handleGenerateCart}
              disabled={generatingCart}
            >
              {generatingCart ? "Dodavanje..." : "🛒 Kupi sve sastojke"}
            </button>
          </div>
        </div>

        <div className="recept-card">
          <div className="recept-header">
            <div className="recept-slika-okvir">
              <img
                src={recept.slika || "https://via.placeholder.com/500"}
                alt={recept.naziv}
              />
            </div>
            <div className="recept-osnovno">
              <span className="kategorija-tag">{recept.kategorija}</span>
              <h1>{recept.naziv}</h1>
              <div className="meta-grid">
                <div className="meta-item">
                  ⏱ <span>{recept.vremePripreme} min</span>
                </div>
                <div className="meta-item">
                  🔥 <span>{recept.brojKalorija} kcal</span>
                </div>
                <div className="meta-item">
                  👥 <span>{recept.brojPorcija} porcije</span>
                </div>
              </div>
            </div>
          </div>

          <div className="recept-sadrzaj">
            <div className="sastojci-sekcija">
              <h3>
                <i className="fa fa-list-ul"></i> Potrebni sastojci
              </h3>
              <ul className="sastojci-lista">
                {recept.recept_proizvod?.map((stavka, index) => (
                  <li key={index}>
                    <span className="dot"></span>
                    <span className="ime">{stavka.naziv}</span>
                    <span className="kolicina-tag">
                      {stavka.pivot?.potrebnaKolicina} {stavka.mernaJedinica}
                    </span>
                  </li>
                ))}
              </ul>
            </div>

            <div className="uputstvo-sekcija">
              <h3>
                <i className="fa fa-utensils"></i> Način pripreme
              </h3>
              <div className="uputstvo-tekst">{recept.uputstvo}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default ReceptDetalji;
