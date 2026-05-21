import "./App.css";
import Home from "./pages/Home";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Proizvodi from "./pages/Proizvodi";
import Recepti from "./pages/Recepti";
import ReceptDetalji from "./pages/ReceptDetalji";
import MojiSastojci from "./pages/MojiSastojci";
import Korpa from "./pages/Korpa";
import Navbar from "./components/NavBar";
import axios from "axios";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import { useState, useEffect } from "react";
import Breadcrumbs from "./components/Breadcrumbs";
import Footer from "./components/Footer";

function App() {
  const [token, setToken] = useState(
    window.sessionStorage.getItem("auth_token"),
  );

  const [user, setUser] = useState(() => {
    const cached = sessionStorage.getItem("user");
    return cached ? JSON.parse(cached) : null;
  });

  useEffect(() => {
    if (!token) {
      setUser(null);
      sessionStorage.removeItem("user");
      return;
    }

    axios
      .get("/api/me", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        setUser(res.data);
        sessionStorage.setItem("user", JSON.stringify(res.data));
      })
      .catch(() => {
        setUser(null);
      });
  }, [token]);

  function addToken(auth_token) {
    setToken(auth_token);

    if (auth_token) {
      window.sessionStorage.setItem("auth_token", auth_token);
    } else {
      window.sessionStorage.removeItem("auth_token");
    }
  }

  function addUser(user) {
    setUser(user);
  }

  return (
    <div className="App">
      <Router>
        <Navbar
          token={token}
          user={user}
          addToken={addToken}
          addUser={addUser}
        />
        <Breadcrumbs />
        <Routes>
          <Route path="/login" element={<Login addToken={addToken} />} />
          <Route path="/register" element={<Register />} />
          <Route path="/" element={<Home token={token} />} />
          <Route path="/proizvodi" element={<Proizvodi />} />
          <Route path="/recepti" element={<Recepti />} />
          <Route path="/recepti/:id" element={<ReceptDetalji />} />
          <Route path="/korpa" element={<Korpa />} />
          <Route path="/pretraga_po_sastojcima" element={<MojiSastojci />} />
        </Routes>
        <Footer />
      </Router>
    </div>
  );
}

export default App;
