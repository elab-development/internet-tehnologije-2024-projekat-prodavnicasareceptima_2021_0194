import React, { useEffect, useState } from "react";
import axios from "axios";
import ReceptItem from "../components/ReceptItem";
import { useNavigate } from "react-router-dom";
import "../styles/Recepti.css";

function Recepti() {
  const navigate = useNavigate();
  const [recepti, setRecepti] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [lastPage, setLastPage] = useState(1);
  const [loading, setLoading] = useState(true);

  // Ostaju samo ova dva filtera
  const [kategorija, setKategorija] = useState("");
  const [vreme, setVreme] = useState("");

  useEffect(() => {
    setLoading(true);
    axios
      .get(`http://127.0.0.1:8000/api/recepti/search`, {
        params: {
          page: currentPage,
          kategorija: kategorija,
          vremePripreme: vreme,
        },
      })
      .then((res) => {
        // Pristupamo tvojoj strukturi: data -> data -> data
        setRecepti(res.data.data.data);
        setLastPage(res.data.data.last_page);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
      });
  }, [currentPage, kategorija, vreme]); // useEffect prati samo kategoriju i vreme

  const resetFilters = () => {
    setKategorija("");
    setVreme("");
    setCurrentPage(1);
  };

  return (
    <div className="recepti-container">
      <h1 className="menuTitle">Naši Recepti</h1>
      {/* DUGME ZA NAVIGACIJU KA SASTOJCIMA */}
      <div className="text-center mb-4">
        <button
          className="btn-go"
          style={{ width: "auto", padding: "10px 30px" }}
          onClick={() => navigate("/pretraga_po_sastojcima")}
        >
          🔍 Pretraga po sastojcima koje imam
        </button>
      </div>
      {/* FILTERI BEZ KALORIJA */}
      <div className="filters-section">
        <select
          value={kategorija}
          onChange={(e) => {
            setKategorija(e.target.value);
            setCurrentPage(1);
          }}
        >
          <option value="">Sve kategorije</option>
          <option value="Doručak">Doručak</option>
          <option value="Ručak">Ručak</option>
          <option value="Večera">Večera</option>
          <option value="Salate">Salate</option>
          <option value="Desert">Deserti</option>
        </select>

        <select
          value={vreme}
          onChange={(e) => {
            setVreme(e.target.value);
            setCurrentPage(1);
          }}
        >
          <option value="">Vreme pripreme</option>
          <option value="do_30">Do 30 min</option>
          <option value="30_60">30 - 60 min</option>
          <option value="preko_60">Preko 60 min</option>
        </select>

        <button className="btn-reset" onClick={resetFilters}>
          Resetuj
        </button>
      </div>

      <div className="recepti-blog-list">
        {loading ? (
          <h3 className="text-center mt-5">Učitavanje...</h3>
        ) : Array.isArray(recepti) && recepti.length > 0 ? (
          recepti.map((r) => (
            <ReceptItem
              key={r.idRecept}
              id={r.idRecept}
              slika={r.slika}
              naziv={r.naziv}
              vreme={r.vremePripreme}
              kalorije={r.brojKalorija}
              porcije={r.brojPorcija}
              kategorija={r.kategorija}
            />
          ))
        ) : (
          <div className="text-center mt-5">
            <p>Nema recepata koji odgovaraju izabranim filterima.</p>
          </div>
        )}
      </div>

      {/* Paginacija ostaje ista */}
      {!loading && recepti.length > 0 && (
        <div className="pagination-container">
          <button
            className="btn-pagination"
            disabled={currentPage === 1}
            onClick={() => {
              setCurrentPage(currentPage - 1);
              window.scrollTo(0, 0);
            }}
          >
            &laquo; Prethodna
          </button>
          <span className="page-info">
            Stranica <strong>{currentPage}</strong> od {lastPage}
          </span>
          <button
            className="btn-pagination"
            disabled={currentPage === lastPage}
            onClick={() => {
              setCurrentPage(currentPage + 1);
              window.scrollTo(0, 0);
            }}
          >
            Sledeća &raquo;
          </button>
        </div>
      )}
    </div>
  );
}

export default Recepti;
