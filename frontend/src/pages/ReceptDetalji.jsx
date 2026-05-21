import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import "../styles/ReceptDetalji.css";

function ReceptDetalji() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [recept, setRecept] = useState(null);
  const [loading, setLoading] = useState(true);
  const [exporting, setExporting] = useState(false); // Stanje za učitavanje PDF-a

  useEffect(() => {
    axios
      .get(`http://127.0.0.1:8000/api/recepti/${id}`)
      .then((res) => {
        console.log("Šta je stiglo iz baze:", res.data.data);
        setRecept(res.data.data || res.data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Greška pri učitavanju recepta:", err);
        setLoading(false);
      });
  }, [id]);

  // FUNKCIJA ZA PREUZIMANJE PDF-a
  const handleExportPdf = async () => {
    setExporting(true);
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/recepti/${id}/export-pdf`,
        {
          responseType: "blob", // Ključno: tražimo fajl, ne tekst
        },
      );

      // Kreiranje linka za automatsko preuzimanje
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", `recept-${id}.pdf`);
      document.body.appendChild(link);
      link.click();
      link.remove();
      setExporting(false);
    } catch (error) {
      console.error("Greška pri izradi PDF-a:", error);
      alert("Došlo je do greške prilikom generisanja PDF-a.");
      setExporting(false);
    }
  };

  if (loading)
    return <div className="loading-state">Učitavanje recepta...</div>;
  if (!recept)
    return <div className="loading-state">Recept nije pronađen.</div>;

  return (
    <div className="detalji-container">
      <div className="top-navigation">
        <button className="btn-back" onClick={() => navigate(-1)}>
          &larr; Povratak na recepte
        </button>

        {/* DUGME ZA PDF */}
        <button
          className="btn-pdf"
          onClick={handleExportPdf}
          disabled={exporting}
        >
          {exporting ? "Generisanje..." : "📄 Sačuvaj kao PDF"}
        </button>
      </div>

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
        <div className="sastojci-blok">
          <h3>Potrebni sastojci</h3>
          <ul className="sastojci-lista">
            {recept.recept_proizvod &&
              recept.recept_proizvod.map((stavka, index) => (
                <li key={index} className="sastojak-red">
                  <span className="kolicina">
                    {stavka.pivot?.potrebnaKolicina} {stavka.mernaJedinica}
                  </span>
                  <span className="ime-proizvoda">{stavka.naziv}</span>
                </li>
              ))}
          </ul>
        </div>

        <div className="uputstvo-blok">
          <h3>Način pripreme</h3>
          <p className="uputstvo-tekst">{recept.uputstvo}</p>
        </div>
      </div>
    </div>
  );
}

export default ReceptDetalji;
