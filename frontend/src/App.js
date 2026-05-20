import './App.css';
import Home from "./pages/Home"
import Navbar from "./components/NavBar"
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";



function App() {
  return (
    <div className="App">
      <Router>
        <Navbar />
        <Routes>
          <Route path="/" element={<Home />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
