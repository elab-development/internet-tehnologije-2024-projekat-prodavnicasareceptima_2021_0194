import { useState, useEffect } from "react";

function useGreeting() {
  const [greeting, setGreeting] = useState("");

  useEffect(() => {
    const hour = new Date().getHours();

    if (hour < 12) {
      setGreeting("Dobro jutro");
    } else if (hour < 18) {
      setGreeting("Dobar dan");
    } else {
      setGreeting("Dobro veče");
    }
  }, []);

  return greeting;
}

export default useGreeting;
