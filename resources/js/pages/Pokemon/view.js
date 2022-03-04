import React from "react";
import { useParams } from "react-router-dom";

function PokemonView() {
    const { id } = useParams();
    return (
        <div className="container">
            <p>id: {id}</p>
            <p>Species id: 2</p>
            <p>identifier: 3</p>
            <p>Height: 5</p>
            <p>Weight: 7</p>
        </div>
    );
}

export default PokemonView;
