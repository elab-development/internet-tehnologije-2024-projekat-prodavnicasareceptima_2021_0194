import React from "react";
import "../styles/NavBar.css";
import axios from "axios";

function NavBar({ token, addToken }) {
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
        window.sessionStorage.setItem("auth_token", null);
        addToken(null);
        alert("Uspešno ste se odjavili.");
      })
      .catch((error) => {
        console.log(error);
      });
  }

  return (
    <nav
      className="navbar navbar-dark bg-success sticky-top"
      aria-label="First navbar example"
    >
      <div className="container-fluid">
        <a className="navbar-brand" href="/">
          Zdravi Zalogaji
        </a>

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
              <a className="nav-link" aria-current="page" href="/">
                Početna
              </a>
            </li>

            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Recepti
              </a>

              <ul className="dropdown-menu">
                <li>
                  <a className="dropdown-item" href="#">
                    Hladna predjela
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Obrok salate
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Supe i potaži
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Glavna jela
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Dezerti
                  </a>
                </li>
              </ul>
            </li>

            <li className="nav-item">
              <a className="nav-link" href="/proizvodi">
                Proizvodi
              </a>
            </li>

            {token == null ? (
              <></>
            ) : (
              <li className="nav-item">
                <a className="nav-link">Korpa</a>
              </li>
            )}

            <li className="nav-item">
              {token == null ? (
                <a className="nav-link" href="/login">
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
    </nav>
  );
}

export default NavBar;
