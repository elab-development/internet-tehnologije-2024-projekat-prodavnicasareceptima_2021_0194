import React from "react";
import "../styles/Login.css";
import { useState } from "react";
import axios from "axios";

function Login() {
  const [userData, setUserData] = useState({
    korisnickoIme: "",
    lozinka: "",
  });

  function handleInput(e) {
    let newUserData = userData;
    newUserData[e.target.name] = e.target.value;
    setUserData(newUserData);
  }

  function handleLogin(e) {
    e.preventDefault();
    axios
      .post("http://127.0.0.1:8000/api/login", userData)
      .then((res) => {
        console.log(res.data);
        if (res.data.success === true) {
          window.sessionStorage.setItem("auth_token", res.data.access_token);
        }
      })
      .catch((e) => {
        console.log(e);
      });
  }

  return (
    <section className="vh-100">
      <div className="container-fluid h-custom">
        <div className="row d-flex justify-content-center align-items-center h-100">
          {/* IMAGE */}
          <div className="col-md-9 col-lg-6 col-xl-5">
            <img
              src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
              className="img-fluid"
              alt="Sample image"
            />
          </div>

          {/* FORM */}
          <div className="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form onSubmit={handleLogin}>
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
                  Korisnicko ime
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

              {/* LOGIN BUTTON */}
              <div className="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  className="btn btn-primary btn-lg"
                  style={{
                    paddingLeft: "2.5rem",
                    paddingRight: "2.5rem",
                  }}
                >
                  Prijavi se
                </button>

                <p className="small fw-bold mt-2 pt-1 mb-0">
                  Nemate nalog?{" "}
                  <a href="#" className="link-danger">
                    Registrujte se
                  </a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Login;
