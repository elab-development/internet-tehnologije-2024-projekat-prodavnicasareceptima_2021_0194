import React from "react";
import "../styles/Home.css";
import Proizvodi from "../pages/Proizvodi";
import Recepti from "../pages/Recepti";

function Home({ token }) {
  return (
    <div className="d-flex h-100 text-center text-bg-dark">
      <div
        className="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"
        style={{ minHeight: "100vh" }}
      >
        <header className="mb-auto">
          <div>
            <nav className="nav nav-masthead justify-content-center float-md-end">
              <a
                className="nav-link fw-bold py-1 px-0 active"
                aria-current="page"
                href="/"
              ></a>

              <a className="nav-link fw-bold py-1 px-0" href="/recepti"></a>

              <a className="nav-link fw-bold py-1 px-0" href="/proizvodi"></a>
              {token == null ? (
                <></>
              ) : (
                <a className="nav-link fw-bold py-1 px-0"></a>
              )}
            </nav>
          </div>
        </header>

        <main className="px-3">
          <h1>Cover your page.</h1>

          <p className="lead">
            Cover is a one-page template for building simple and beautiful home
            pages. Download, edit the text, and add your own fullscreen
            background photo to make it your own.
          </p>

          <p className="lead">
            <a
              href="#"
              className="btn btn-lg btn-light fw-bold border-white bg-white"
            >
              Learn more
            </a>
          </p>
        </main>
        <footer className="mt-auto text-white-50"></footer>
      </div>
    </div>
  );
}

export default Home;
