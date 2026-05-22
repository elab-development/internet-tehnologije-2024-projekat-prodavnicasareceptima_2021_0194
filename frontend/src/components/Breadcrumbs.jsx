import React from "react";
import { Link, useLocation } from "react-router-dom";
import "../styles/Breadcrumbs.css";

function Breadcrumbs() {
  const location = useLocation();

  // Ako smo na početnoj stranici, ne prikazujemo breadcrumbs
  if (location.pathname === "/") {
    return null;
  }

  // Razbijamo putanju na delove
  const pathnames = location.pathname.split("/").filter((x) => x);

  // Mapa tvojih ruta iz App.js
  const breadcrumbNameMap = {
    proizvodi: "Ponuda proizvoda",
    recepti: "Recepti",
    korpa: "Moja korpa",
    pretraga_po_sastojcima: "Pretraga po sastojcima",
    login: "Prijava",
    register: "Registracija",
  };

  return (
    <nav className="breadcrumbs-wrapper">
      <div className="breadcrumbs-content">
        <Link to="/">Početna</Link>

        {pathnames.map((value, index) => {
          const last = index === pathnames.length - 1;
          const to = `/${pathnames.slice(0, index + 1).join("/")}`;

          // Logika za prikaz imena:
          // 1. Ako je u mapi (npr. 'recepti' -> 'Recepti')
          // 2. Ako je broj (ID recepta), pišemo "Detalji recepta"
          // 3. Inače koristimo samu reč
          let name = breadcrumbNameMap[value];
          if (!name) {
            name = !isNaN(value) ? "Detalji recepta" : value;
          }

          return last ? (
            <span key={to} className="breadcrumb-current">
              {" "}
              / {name}
            </span>
          ) : (
            <span key={to}>
              {" "}
              / <Link to={to}>{name}</Link>
            </span>
          );
        })}
      </div>
    </nav>
  );
}

export default Breadcrumbs;
