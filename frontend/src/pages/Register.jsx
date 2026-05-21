import React from "react";
import "../styles/Login.css";
import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

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
    <section className="vh-100">
      <div className="container-fluid h-custom">
        <div className="row d-flex justify-content-center align-items-center h-100">
          {/* IMAGE */}
          <div className="col-md-9 col-lg-6 col-xl-5">
            <img
              src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
              className="img-fluid"
              alt="Sample image"
            />
          </div>

          {/* FORM */}
          <div className="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form onSubmit={handleRegister}>
              <h3>Registracija</h3>
              {/* USERNAME */}
              <div className="form-outline mb-4">
                <input
                  type="text"
                  id="form3Example3"
                  className="form-control form-control-lg"
                  placeholder="Unesite korisničko ime"
                  name="korisnickoIme"
                  onInput={handleInput}
                />
                <label className="form-label" htmlFor="form3Example3">
                  Korisničko ime
                </label>
              </div>

              {/* PASSWORD */}
              <div className="form-outline mb-3">
                <input
                  type="password"
                  id="form3Example4"
                  className="form-control form-control-lg"
                  placeholder="Unesite lozinku"
                  name="lozinka"
                  onInput={handleInput}
                />
                <label className="form-label" htmlFor="form3Example4">
                  Lozinka
                </label>
              </div>
              {errorMessage && <p className="text-danger">{errorMessage}</p>}

              {/* Register BUTTON */}
              <div className="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  className="btn btn-primary btn-lg"
                  style={{
                    paddingLeft: "2.5rem",
                    paddingRight: "2.5rem",
                  }}
                >
                  Registruj se
                </button>

                <p className="small fw-bold mt-2 pt-1 mb-0">
                  Već imate nalog?{" "}
                  <a href="/login" className="link-danger">
                    Prijavite se
                  </a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
      {showSuccess && (
        <div style={styles.overlay}>
          <div style={styles.popup}>
            <h2>✔ Uspeh</h2>
            <p>Uspešno ste se registrovali!</p>

            <button
              onClick={() => {
                setShowSuccess(false);
                navigate("/login");
              }}
            >
              OK
            </button>
          </div>
        </div>
      )}
    </section>
  );
}

export default Register;
