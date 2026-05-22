import React from "react";
import "../styles/Login.css";
import { useState } from "react";
import axios from "axios";
import { useNavigate, Link } from "react-router-dom";

function Login({ addToken }) {
  const [userData, setUserData] = useState({
    korisnickoIme: "",
    lozinka: "",
  });

  function handleInput(e) {
    let newUserData = userData;
    newUserData[e.target.name] = e.target.value;
    setUserData(newUserData);
  }

  let navigate = useNavigate();

  const [errorMessage, setErrorMessage] = useState();
  const [showSuccess, setShowSuccess] = useState(false);
  const [loading, setLoading] = useState(false);

  function handleLogin(e) {
    e.preventDefault();
    setErrorMessage("");
    axios
      .post("/api/login", userData)
      .then((res) => {
        console.log(res.data);
        if (res.data.success === true) {
          const token = res.data.access_token;
          window.sessionStorage.setItem("auth_token", token);
          addToken(token);
          axios
            .get("/api/me", {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            })
            .then((r) => {
              window.sessionStorage.setItem("user", JSON.stringify(r.data));
            });
          setShowSuccess(true);
        } else {
          setErrorMessage(
            "Pogrešno korisničko ime ili lozinka, pokušajte ponovo.",
          );
        }
      })
      .catch((e) => {
        console.log(e);
        setErrorMessage("Došlo je do greške, pokušajte ponovo");
      });
  }

  return (
    <div className="login-page-wrapper">
      <div className="login-card">
        <div className="login-header">
          <h2>Dobrodošli nazad</h2>
          <p>Prijavite se da biste nastavili sa kupovinom</p>
        </div>
        <form onSubmit={handleLogin} className="login-form">
          <div className="custom-input-group">
            <label>Korisničko ime</label>
            <input
              type="text"
              placeholder="Unesite korisničko ime"
              name="korisnickoIme"
              onInput={handleInput}
            />
          </div>
          <div className="custom-input-group">
            <label>Lozinka</label>
            <input
              type="password"
              placeholder="Unesite lozinku"
              name="lozinka"
              onInput={handleInput}
            />
          </div>
          {errorMessage && <p className="error-alert">{errorMessage}</p>}

          <button type="submit" className="btn-login-submit" disabled={loading}>
            {loading ? "Prijava u toku..." : "Prijavi se"}
          </button>

          <p className="register-redirect">
            Nemate nalog? <Link to="/register">Registrujte se besplatno</Link>
          </p>
        </form>
      </div>

      {showSuccess && (
        <div className="success-overlay">
          <div className="success-modal">
            <div className="success-icon">✓</div>
            <h3>Uspešna prijava</h3>
            <p>Drago nam je što ste ponovo tu!</p>
            <button
              onClick={() => {
                setShowSuccess(false);
                navigate("/");
              }}
              className="btn-modal-ok"
            >
              Nastavi na početnu
            </button>
          </div>
        </div>
      )}
    </div>
  );
}

export default Login;
