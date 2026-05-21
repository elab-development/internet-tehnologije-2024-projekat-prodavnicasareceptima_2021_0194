import React, { useEffect, useState } from "react";
import axios from "axios";
import KorpaItem from "../components/KorpaItem";
import "../styles/Korpa.css";

function Korpa() {
  const [korpa, setKorpa] = useState(null);
  const [stavke, setStavke] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const fetchKorpa = async () => {
      try {
        const token = sessionStorage.getItem("auth_token");
        const res = await axios.get("http://127.0.0.1:8000/api/korpa", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        setKorpa(res.data.korpa);
        setStavke(res.data.stavke);
      } catch (err) {
        setError(err.response?.data?.message || "Greška pri učitavanju korpe");
      } finally {
        setLoading(false);
      }
    };

    fetchKorpa();
  }, []);

  if (loading)
    return (
      <div className="korpa-container">
        <p className="empty-cart-msg">Učitavanje...</p>
      </div>
    );
  if (error)
    return (
      <div className="korpa-container">
        <p className="empty-cart-msg">{error}</p>
      </div>
    );

  return (
    <div className="korpa-container">
      <h1 className="korpa-title">Vaša Korpa</h1>

      <div className="korpa-list">
        {stavke.length === 0 ? (
          <p className="empty-cart-msg">Korpa je trenutno prazna.</p>
        ) : (
          stavke.map((s) => <KorpaItem key={s.idKorpaStavka} s={s} />)
        )}
      </div>

      {stavke.length > 0 && (
        <div className="korpa-total">
          <h3>
            Ukupno za uplatu:{" "}
            <span style={{ color: "#2d5a27" }}>{korpa?.ukupnaCena} RSD</span>
          </h3>
          <button
            className="btn btn-success btn-lg mt-3"
            style={{ borderRadius: "25px", padding: "10px 30px" }}
          >
            Nastavi na plaćanje
          </button>
        </div>
      )}
    </div>
  );
}

export default Korpa;
