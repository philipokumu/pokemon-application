<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pokemon extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'pokemons',
                'pokemon_id' => $this->id,
                'attributes' => [
                    'id' => $this->id,
                    'identifier' => $this->identifier,
                    'species_id' => $this->species_id,
                    'height' => $this->height,
                    'weight' => $this->weight,
                    'base_experience' => $this->base_experience,
                    'order' => $this->order,
                    'is_default' => $this->is_default
                ]
            ]
        ];
    }
}
