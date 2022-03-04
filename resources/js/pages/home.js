import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import ProtectedRoutes from "../components/ProtectedRoutes";
import Login from "./LoginPage";
import Pokemon from "./Pokemon";
import PokemonView from "./Pokemon/view";
function Home() {
    return (
        <Router>
            <Routes>
                <Route path="/login" element={<Login />} />
                <Route element={<ProtectedRoutes />}>
                    <Route path="/" element={<Pokemon />} />
                    <Route path="/pokemons/:id" element={<PokemonView />} />
                    <Route path="*" element={<h1>There is no such page</h1>} />
                </Route>
            </Routes>
        </Router>
    );
}
export default Home;
// DOM element
if (document.getElementById("home")) {
    ReactDOM.render(<Home />, document.getElementById("home"));
}
