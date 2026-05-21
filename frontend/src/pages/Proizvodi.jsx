import React from "react";
import "../styles/Proizvodi.css";
import ProizvodItem from "../components/ProizvodItem";
import { useEffect, useState } from "react";
import axios from "axios";

function Proizvodi() {
  const [proizvodi, setProizvodi] = useState([]);
  const [currentPage, setCurrentPage] = useState(1); // Pratimo na kojoj smo stranici
  const [lastPage, setLastPage] = useState(1); // Pratimo koliko ukupno ima stranica

  useEffect(() => {
    // Dodajemo ?page= na kraj URL-a
    axios
      .get(`http://127.0.0.1:8000/api/proizvodi?page=${currentPage}`)
      .then((res) => {
        // Laravel paginacija podatke drži u res.data.data
        setProizvodi(res.data.data);
        setLastPage(res.data.last_page);
      })
      .catch((err) => {
        console.log(err);
      });
  }, [currentPage]); // useEffect se ponovo pokreće svaki put kad se promeni stranica

  return (
    <div className="menu">
      <h1 className="menuTitle"> Ponuda proizvoda </h1>
      <div className="menuList">
        {proizvodi.map((p) => (
          <ProizvodItem
            key={p.idProizvod}
            image={p.slika}
            naziv={p.naziv}
            cena={p.cena}
            // onAddToCart={() => addToCart(p)}
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
