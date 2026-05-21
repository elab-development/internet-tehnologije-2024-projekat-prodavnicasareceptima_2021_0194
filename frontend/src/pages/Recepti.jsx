import React, { useEffect, useState } from "react";
import axios from "axios";
import ReceptItem from "../components/ReceptItem";
import "../styles/Recepti.css"; // Uvozimo novi CSS za blog izgled

function Recepti() {
  const [recepti, setRecepti] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [lastPage, setLastPage] = useState(1);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    setLoading(true);
    // Koristimo backticks `` za ispravnu paginaciju
    axios
      .get(`http://127.0.0.1:8000/api/recepti?page=${currentPage}`)
      .then((res) => {
        console.log("Podaci sa API-ja:", res.data);

        // Pristupamo dubokoj strukturi: res -> data -> data -> data
        const nizRecepata = res.data.data.data;
        const ukupnoStranica = res.data.data.last_page;

        setRecepti(nizRecepata);
        setLastPage(ukupnoStranica);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Greška pri učitavanju recepata:", err);
        setLoading(false);
      });
  }, [currentPage]);

  if (loading) {
    return (
      <div className="recepti-container">
        <div className="text-center mt-5">
          <h3>Pripremanje kulinarske inspiracije...</h3>
        </div>
      </div>
    );
  }

  return (
    <div className="recepti-container">
      <h1 className="menuTitle">Naši Recepti</h1>
      <p className="subtitle">Pronađite savršen obrok za svaku priliku</p>

      {/* Lista recepata - ređaju se jedan ispod drugog */}
      <div className="recepti-blog-list">
        {Array.isArray(recepti) && recepti.length > 0 ? (
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
            <p>Trenutno nema recepata za prikaz.</p>
          </div>
        )}
      </div>

      {/* Kontrole za paginaciju na dnu strane */}
      <div className="pagination-container">
        <button
          className="btn-pagination"
          disabled={currentPage === 1}
          onClick={() => {
            setCurrentPage(currentPage - 1);
            window.scrollTo(0, 0); // Vraća na vrh stranice pri promeni
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
            window.scrollTo(0, 0); // Vraća na vrh stranice pri promeni
          }}
        >
          Sledeća &raquo;
        </button>
      </div>
    </div>
  );
}

export default Recepti;
