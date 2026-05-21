import React from "react";
import "../styles/NavBar.css";
import axios from "axios";
import { useState, useEffect } from "react";
import { useNavigate, useLocation } from "react-router-dom";

function NavBar({ token, user, addToken, addUser }) {
  let navigate = useNavigate();
  const location = useLocation();
  const isActive = (path) => location.pathname === path;

  const kategorijeRecepata = ["Doručak", "Ručak", "Večera", "Salate", "Desert"];

  function handleLogout(e) {
    e.preventDefault();
    let config = {
      method: "post",
      maxBodyLength: Infinity,
      url: "/api/logout",
      headers: {
        Authorization: `Bearer ${token}`,
      },
    };

    axios
      .request(config)
      .then((response) => {
        console.log(JSON.stringify(response.data.message));
        window.sessionStorage.removeItem("auth_token");
        addUser(null);
        addToken(null);
        setShowSuccess(true);
      })
      .catch((error) => {
        console.log(error);
      });
  }
  const [showSuccess, setShowSuccess] = useState(false);

  const styles = {
    overlay: {
      position: "fixed",
      top: 0,
      left: 0,
      width: "100%",
      height: "100%",
      background: "rgba(0,0,0,0.5)",
      display: "flex",
      justifyContent: "center",
      alignItems: "center",
      zIndex: 9999,
    },
    popup: {
      background: "white",
      padding: "25px",
      borderRadius: "12px",
      textAlign: "center",
      width: "280px",
      boxShadow: "0 10px 30px rgba(0,0,0,0.2)",
    },
  };
  const handleCategoryClick = (kategorija) => {
    // Navigira na /recepti i šalje "state" objekat sa izabranom kategorijom
    navigate("/recepti", { state: { izabranaKategorija: kategorija } });
  };
  return (
    <nav
      className="navbar navbar-dark custom-navbar sticky-top"
      aria-label="First navbar example"
    >
      <div className="container-fluid d-flex align-items-center">
        <div className="d-flex align-items-center">
          <a className="navbar-brand" href="/">
            {/* IKONICA LOGOA */}
            <img src="/logo.png" alt="Logo" className="navbar-logo" />
            Zdravi Zalogaji
          </a>
          <span className="navbar-text text-white ms-2">
            {user ? `👋 Zdravo, ${user.korisnickoIme}` : "👤 Gost"}
          </span>
        </div>

        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarsExample01"
          aria-controls="navbarsExample01"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarsExample01">
          <ul className="navbar-nav me-auto mb-2">
            <li className="nav-item">
              <a
                className={`nav-link ${isActive("/") ? "active fw-bold" : ""}`}
                aria-current="page"
                href="/"
              >
                Početna
              </a>
            </li>

            <li className="nav-item dropdown d-flex align-items-center">
              {/* GLAVNI LINK ZA RECEPTE */}
              <a
                className={`nav-link  ${
                  location.pathname.startsWith("/recepti") ||
                  location.pathname === "/pretraga_po_sastojcima"
                    ? "active fw-bold"
                    : ""
                }`}
                href="/recepti"
                // onClick={() => handleCategoryClick("")}
              >
                Recepti
              </a>

              {/* SAMO STRELICA ZA DROPDOWN */}
              <span
                className="nav-link dropdown-toggle dropdown-toggle-split"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              />
              <ul className="dropdown-menu">
                {kategorijeRecepata.map((kat) => (
                  <li key={kat}>
                    <a
                      className="dropdown-item"
                      href="#" // Ne treba href da preusmerava, koristimo onClick
                      onClick={(e) => {
                        e.preventDefault(); // Sprečavamo default ponašanje linka
                        handleCategoryClick(kat);
                      }}
                    >
                      {kat}
                    </a>
                  </li>
                ))}
              </ul>
            </li>

            <li className="nav-item">
              <a
                className={`nav-link ${isActive("/proizvodi") ? "active fw-bold" : ""}`}
                href="/proizvodi"
              >
                Proizvodi
              </a>
            </li>

            <li className="nav-item">
              {token == null ? (
                <></>
              ) : (
                <a
                  className={`nav-link ${isActive("/korpa") ? "active fw-bold" : ""}`}
                  href="/korpa"
                >
                  Korpa
                </a>
              )}
            </li>

            <li className="nav-item">
              {token == null ? (
                <a
                  className={`nav-link ${isActive("/login") ? "active fw-bold" : ""}`}
                  href="/login"
                >
                  Prijavi se
                </a>
              ) : (
                <a className="nav-link" href="/" onClick={handleLogout}>
                  Odjavi se
                </a>
              )}
            </li>
          </ul>

          {/* <form role="search">
            <input
                className="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
            />
            </form> */}
        </div>
      </div>
      {showSuccess && (
        <div style={styles.overlay}>
          <div style={styles.popup}>
            <h2>✔ Uspeh</h2>
            <p>Uspešno ste se odjavili!</p>

            <button
              onClick={() => {
                setShowSuccess(false);
                navigate("/");
              }}
            >
              OK
            </button>
          </div>
        </div>
      )}
    </nav>
  );
}

export default NavBar;
