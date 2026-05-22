import React from "react";
import "../styles/Proizvodi.css";
import ProizvodItem from "../components/ProizvodItem";
import { useEffect, useState } from "react";
import axios from "axios";

function Proizvodi() {
  const [proizvodi, setProizvodi] = useState([]);
  const [currentPage, setCurrentPage] = useState(1); // Pratimo na kojoj smo stranici
  const [lastPage, setLastPage] = useState(1); // Pratimo koliko ukupno ima stranica
  const [idKorpa, setIdKorpa] = useState(null); // Čuvamo ID korpe u stanju

  const token = sessionStorage.getItem("auth_token");

  useEffect(() => {
    if (token) {
      axios
        .get("/api/korpa", {
          headers: { Authorization: `Bearer ${token}` },
        })
        .then((res) => {
          setIdKorpa(res.data.korpa.idKorpa); // Uzimamo ID iz odgovora
        })
        .catch((err) => console.log("Greška pri uzimanju korpe:", err));
    }
  }, [token]);

  useEffect(() => {
    // Dodajemo ?page= na kraj URL-a
    axios
      .get(`/api/proizvodi?page=${currentPage}`)
      .then((res) => {
        // Laravel paginacija podatke drži u res.data.data
        setProizvodi(res.data.data);
        setLastPage(res.data.last_page);
      })
      .catch((err) => {
        console.log(err);
      });
  }, [currentPage]); // useEffect se ponovo pokreće svaki put kad se promeni stranica

  const handleAddToCart = (idProizvod, izabranaKolicina) => {
    if (!idKorpa) {
      alert("Morate biti ulogovani da biste dodali u korpu!");
      return;
    }

    const token = sessionStorage.getItem("auth_token");

    axios
      .put(
        `/api/korpa/${idKorpa}/proizvod/${idProizvod}`,
        {
          kolicina: izabranaKolicina, // Šaljemo broj iz inputa
        },
        {
          headers: { Authorization: `Bearer ${token}` },
        },
      )
      .then((res) => {
        alert(`Dodato ${izabranaKolicina} u korpu!`);
      })
      .catch((err) => {
        console.log(err);
        alert("Greška pri dodavanju.");
      });
  };

  return (
    <div className="menu">
      <h1 className="menuTitle"> Ponuda proizvoda </h1>
      <div className="menuList">
        {proizvodi.map((p) => (
          <ProizvodItem
            key={p.idProizvod}
            id={p.idProizvod}
            image={p.slika}
            naziv={p.naziv}
            cena={p.cena}
            jedinica={p.mernaJedinica}
            onAddToCart={handleAddToCart}
          />
        ))}
      </div>
      <div className="pagination-container mt-4 text-center">
        <button
          className="btn btn-success me-2"
          disabled={currentPage === 1}
          onClick={() => setCurrentPage(currentPage - 1)}
        >
          Prethodna
        </button>

        <span className="mx-3">
          Stranica {currentPage} od {lastPage}
        </span>

        <button
          className="btn btn-success"
          disabled={currentPage === lastPage}
          onClick={() => setCurrentPage(currentPage + 1)}
        >
          Sledeća
        </button>
      </div>
    </div>
  );
}

export default Proizvodi;
