import React from "react";
import "../styles/NavBar.css";
import axios from "axios";
import { LuUserRound, LuUserRoundCheck } from "react-icons/lu";
import { useState, useEffect } from "react";
import { useNavigate, useLocation } from "react-router-dom";

function NavBar({ token, user, addToken, addUser }) {
  let navigate = useNavigate();
  const location = useLocation();
  const isActive = (path) => location.pathname === path;

  const [isNavOpen, setIsNavOpen] = useState(false);
  const closeMenu = () => setIsNavOpen(false);

  const kategorijeRecepata = ["Doručak", "Ručak", "Večera", "Salate", "Desert"];

  function handleLogout(e) {
    e.preventDefault();
    closeMenu();
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
          <a className="navbar-brand d-flex align-items-center" href="/">
            <img src="/logo.png" alt="Logo" className="navbar-logo" />
            Zdravi Zalogaji
          </a>
          <div className="nav-user-profile">
            {user ? (
              <div className="user-badge">
                <LuUserRoundCheck className="nav-icon-green" />
                <span className="nav-username">
                  Zdravo, {user.korisnickoIme}
                </span>
              </div>
            ) : (
              <div className="user-badge guest">
                <LuUserRound className="nav-icon-gray" />
                <span className="nav-username">Gost</span>
              </div>
            )}
          </div>
        </div>

        {/* MODIFIKOVANO DUGME */}
        <button
          className={`navbar-toggler ${isNavOpen ? "opened" : ""}`}
          type="button"
          onClick={() => setIsNavOpen(!isNavOpen)}
          aria-label="Toggle navigation"
        >
          {/* Umesto standardne ikonice, pravimo našu koja može da se animira u X */}
          <div className="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </button>

        {/* MODIFIKOVAN COLLAPSE DIV */}
        <div className={`collapse navbar-collapse ${isNavOpen ? "show" : ""}`}>
          <ul className="navbar-nav me-auto mb-2">
            <li className="nav-item">
              <a
                className={`nav-link ${isActive("/") ? "active fw-bold" : ""}`}
                href="/"
                onClick={closeMenu}
              >
                Početna
              </a>
            </li>

            <li className="nav-item dropdown custom-dropdown">
              <div className="nav-link-wrapper">
                <a
                  className={`nav-link ${location.pathname.startsWith("/recepti") ? "active fw-bold" : ""}`}
                  href="/recepti"
                  onClick={closeMenu}
                >
                  Recepti
                </a>
                <span className="dropdown-arrow">▾</span>
              </div>

              <ul className="dropdown-menu modern-dropdown">
                <li className="dropdown-header">Kategorije jela</li>
                {kategorijeRecepata.map((kat) => (
                  <li key={kat}>
                    <button
                      className="dropdown-item modern-item"
                      onClick={() => {
                        navigate("/recepti", {
                          state: { izabranaKategorija: kat },
                        });
                        closeMenu();
                      }}
                    >
                      <span className="dot">•</span> {kat}
                    </button>
                  </li>
                ))}
              </ul>
            </li>

            <li className="nav-item">
              <a
                className={`nav-link ${isActive("/proizvodi") ? "active fw-bold" : ""}`}
                href="/proizvodi"
                onClick={closeMenu}
              >
                Proizvodi
              </a>
            </li>

            {token && (
              <li className="nav-item">
                <a
                  className={`nav-link ${isActive("/korpa") ? "active fw-bold" : ""}`}
                  href="/korpa"
                  onClick={closeMenu}
                >
                  Korpa
                </a>
              </li>
            )}

            <li className="nav-item">
              {token == null ? (
                <a
                  className={`nav-link ${isActive("/login") ? "active fw-bold" : ""}`}
                  href="/login"
                  onClick={closeMenu}
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
