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

    public function calPoints($ops) {
        $output_array = [];
        for($i=0; $i<count($ops); $i++) {
            echo $ops[$i];
            if (is_numeric(intval($ops[$i]))){
                array_push($output_array,(intval($ops[$i])));
            } else if ($ops[$i]==='+') {
                $total = $output_array[$i-1] + $output_array[$i-2];
                array_push($output_array,$total);
                
            } else if (strval($ops[$i])=="D"){
            // } else if (strcasecmp(strval($ops[$i]),'D')){
                $doubled = $output_array[$i] *2;
                dd($doubled);
                array_push($output_array, $doubled);
                
            } else if ($ops[$i]==='C') {
                array_pop($output_array);
            }
            // dd(array_sum($output_array));
            // echo array_sum($output_array);
            }
        
        }

        public function callpnts(){
        $ops = ['5','2','C','D','+'];
        return $this->calPoints($ops);

        }
        
        
}
