import React, { useCallback, useState } from "react";
import Header from "../../components/Header";
import PokemonCard from "../../components/PokemonCard";
const Pokemon = () => {
    const [pokemons, setPokemons] = useState([]);

    React.useEffect(() => {
        getPokemons();
    }, []);

    const getPokemons = () => {
        const token = localStorage.getItem("userToken");
        axios
            .get("api/pokemons", {
                headers: { Authorization: `Bearer ${token}` },
            })
            .then((response) => {
                setPokemons(response.data.data);
            });
    };

    return (
        <>
            <Header />
            <table className="table-auto ml-12">
                <thead>
                    <tr>
                        <th className="py-3 px-6 font-bold">id</th>
                        <th className="py-3 px-6 font-bold">identifier</th>
                        <th className="py-3 px-6 font-bold">species id</th>
                        <th className="py-3 px-6 font-bold">height</th>
                        <th className="py-3 px-6 font-bold">weight</th>
                        <th className="py-3 px-6 font-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {pokemons.map((pokemon) => (
                        <PokemonCard
                            pokemon={pokemon}
                            key={pokemon.data.pokemon_id}
                        />
                    ))}
                </tbody>
            </table>
        </>
    );
};
export default Pokemon;
