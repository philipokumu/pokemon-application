<?php

namespace App\Http\Controllers;

use App\Http\Resources\Pokemon as PokemonResource;
use App\Http\Resources\PokemonCollection;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as  Rule;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();

        return new PokemonCollection($pokemons);
    }

    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $data = $request->validate([
            'identifier' => 'required',
            'species_id' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'base_experience' => 'required|numeric',
            'order' => 'required|numeric',
            'is_default' => ['required','numeric', Rule::in([1,2])]
        ]);

        $pokemon->update($data);

        return new PokemonResource($pokemon);
    }
}
