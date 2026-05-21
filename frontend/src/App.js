import "./App.css";
import Home from "./pages/Home";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Proizvodi from "./pages/Proizvodi";
import Recepti from "./pages/Recepti";
import ReceptDetalji from "./pages/ReceptDetalji";
import Navbar from "./components/NavBar";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import { useState } from "react";

function App() {
  const [token, setToken] = useState();

  function addToken(auth_token) {
    setToken(auth_token);
  }

  return (
    <div className="App">
      <Router>
        <Navbar token={token} addToken={addToken} />
        <Routes>
          <Route path="/login" element={<Login addToken={addToken} />} />
          <Route path="/register" element={<Register />} />
          <Route path="/" element={<Home token={token} />} />
          <Route path="/proizvodi" element={<Proizvodi />} />
          <Route path="/recepti" element={<Recepti />} />
          <Route path="/recepti/:id" element={<ReceptDetalji />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
