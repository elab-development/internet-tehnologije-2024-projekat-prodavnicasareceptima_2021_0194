import React from "react";
import "../styles/Register.css";
import { useState } from "react";
import axios from "axios";
import { useNavigate, Link } from "react-router-dom";

function Register() {
  const [userData, setUserData] = useState({
    korisnickoIme: "",
    lozinka: "",
  });

  let navigate = useNavigate();

  function handleInput(e) {
    let newUserData = userData;
    newUserData[e.target.name] = e.target.value;
    setUserData(newUserData);
  }

  const [errorMessage, setErrorMessage] = useState();
  const [showSuccess, setShowSuccess] = useState(false);
  const [loading, setLoading] = useState(false);

  function handleRegister(e) {
    e.preventDefault();
    setErrorMessage("");
    axios
      .post("/api/register", userData)
      .then((res) => {
        console.log(res.data);
        if (res.data.success === true) {
          window.sessionStorage.setItem("auth_token", res.data.access_token);
          // eslint-disable-next-line no-alert
          setShowSuccess(true);
          //navigate("/login");
        } else {
          setErrorMessage(res.data.message);
        }
      })
      .catch((e) => {
        console.log(e);
        setErrorMessage("Došlo je do greške");
      });
  }

  return (
    <div className="register-page-container">
      <div className="register-card-horizontal">
        <div className="register-image-side">
          <div className="image-overlay-light">
            <h2>
              Pridruži se našoj <br /> zdravoj zajednici
            </h2>
            <p>Prirodno & Zdravo</p>
          </div>
        </div>

        <div className="register-form-side">
          <div className="form-header">
            <h3>Registracija</h3>
            <p>Napravite nalog i počnite sa kuvanjem</p>
          </div>

          <form onSubmit={handleRegister} className="aesthetic-form">
            <div className="input-field-group">
              <label>Korisničko ime</label>
              <input
                type="text"
                placeholder="Unesite korisničko ime"
                name="korisnickoIme"
                onInput={handleInput}
              />
            </div>

            <div className="input-field-group">
              <label>Lozinka</label>
              <input
                type="password"
                placeholder="Unesite lozinku (minimum 8 karaktera)"
                name="lozinka"
                onInput={handleInput}
              />
            </div>
            {errorMessage && <p className="register-error">{errorMessage}</p>}

            <button
              type="submit"
              className="btn-register-main"
              disabled={loading}
            >
              {loading ? "Kreiranje naloga..." : "Otvori nalog"}
            </button>

            <p className="login-link-text">
              Već imate nalog? <Link to="/login">Prijavite se</Link>
            </p>
          </form>
        </div>
      </div>

      {showSuccess && (
        <div className="modal-success-overlay">
          <div className="modal-success-card">
            <div className="success-check">✓</div>
            <h3>Dobrodošli!</h3>
            <p>Vaš nalog je uspešno kreiran. Sada se možete prijaviti.</p>

            <button
              onClick={() => {
                setShowSuccess(false);
                navigate("/login");
              }}
              className="btn-modal-continue"
            >
              Idi na prijavu
            </button>
          </div>
        </div>
      )}
    </div>
  );
}

export default Register;
