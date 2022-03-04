import React from "react";
import { generatePath, Link } from "react-router-dom";

function PokemonCard({ pokemon }) {
    const route_id = pokemon.data.pokemon_id;
    return (
        <tr>
            <td className="px-3">{pokemon.data.pokemon_id}</td>
            <td className="px-3">{pokemon.data.attributes.identifier}</td>
            <td className="px-3">{pokemon.data.attributes.species_id}</td>
            <td className="px-3">{pokemon.data.attributes.height}</td>
            <td className="px-3">{pokemon.data.attributes.weight}</td>
            <td className="text-blue-500">
                <Link to={generatePath(`pokemons/${route_id}`)}>View</Link>
            </td>
        </tr>
    );
}

export default PokemonCard;
