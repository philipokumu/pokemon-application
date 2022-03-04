<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_fetch_single_pokemon()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemon = Pokemon::factory()->create();

        $response = $this->get('api/pokemons/' . $pokemon->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'type' => 'pokemons',
                    'pokemon_id' => $pokemon->id,
                    'attributes' => [
                        'identifier' => $pokemon->identifier,
                        'species_id' => $pokemon->species_id,
                        'height' => $pokemon->height,
                        'weight' => $pokemon->weight,
                        'base_experience' => $pokemon->base_experience,
                        'order' => $pokemon->order,
                        'is_default' => $pokemon->is_default
                    ]
                ],
            ]);

    }

    public function test_user_can_fetch_pokemon_list()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemons = Pokemon::factory(2)->create();

        $response = $this->get('api/pokemons');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'pokemons',
                            'pokemon_id' => $pokemons->first()->id,
                            'attributes' => [
                                'identifier' => $pokemons->last()->identifier,
                                'species_id' => $pokemons->first()->species_id,
                                'height' => $pokemons->first()->height,
                                'weight' => $pokemons->first()->weight,
                                'base_experience' => $pokemons->first()->base_experience,
                                'order' => $pokemons->first()->order,
                                'is_default' => $pokemons->first()->is_default
                            ]
                        ]
                    ],
                    [
                        'data' => [
                            'type' => 'pokemons',
                            'pokemon_id' => $pokemons->last()->id,
                            'attributes' => [
                                'identifier' => $pokemons->last()->identifier,
                                'species_id' => $pokemons->last()->species_id,
                                'height' => $pokemons->last()->height,
                                'weight' => $pokemons->last()->weight,
                                'base_experience' => $pokemons->last()->base_experience,
                                'order' => $pokemons->last()->order,
                                'is_default' => $pokemons->last()->is_default
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function test_user_can_edit_single_pokemon()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemon = Pokemon::factory()->create([
            'identifier' => 'Wartortle',
            'species_id' => 4,
            'height' => 7,
            'weight' => 6,
            'base_experience' => 443,
            'order' => 30000,
            'is_default' => 0
        ]);

        $response = $this->put('api/pokemons/' . $pokemon->id,[
            'identifier' => 'Warturtle',
            'species_id' => 5,
            'height' => 8,
            'weight' => 7,
            'base_experience' => 444,
            'order' => 40000,
            'is_default' => 1
        ]);

        $updated_pokemon = Pokemon::first();

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'type' => 'pokemons',
                    'pokemon_id' => $updated_pokemon->id,
                    'attributes' => [
                        'identifier' => $updated_pokemon->identifier,
                        'species_id' => $updated_pokemon->species_id,
                        'height' => $updated_pokemon->height,
                        'weight' => $updated_pokemon->weight,
                        'base_experience' => $updated_pokemon->base_experience,
                        'order' => $updated_pokemon->order,
                        'is_default' => $updated_pokemon->is_default
                    ]
                ],
            ]);
    }

    /** VALIDATIONS */
    public function test_all_fields_are_required_when_updating()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemon = Pokemon::factory()->create();

        $response = $this->put('api/pokemons/' . $pokemon->id,[
            'identifier' => '',
            'species_id' => '',
            'height' => '',
            'weight' => '',
            'base_experience' => '',
            'order' => '',
            'is_default' => ''
        ]);

        $responseString = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('identifier', $responseString['errors']['meta']);
        $this->assertArrayHasKey('species_id', $responseString['errors']['meta']);
        $this->assertArrayHasKey('height', $responseString['errors']['meta']);
        $this->assertArrayHasKey('weight', $responseString['errors']['meta']);
        $this->assertArrayHasKey('base_experience', $responseString['errors']['meta']);
        $this->assertArrayHasKey('order', $responseString['errors']['meta']);
        $this->assertArrayHasKey('is_default', $responseString['errors']['meta']);
    }

    public function test_six_fields_should_be_numeric_when_updating()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemon = Pokemon::factory()->create();

        $response = $this->put('api/pokemons/' . $pokemon->id,[
            'identifier' => 'warturtle',
            'species_id' => 'six',
            'height' => 'seven',
            'weight' => 'eight',
            'base_experience' => 'nine',
            'order' => 'ten',
            'is_default' => 'one'
        ]);

        $responseString = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('species_id', $responseString['errors']['meta']);
        $this->assertArrayHasKey('height', $responseString['errors']['meta']);
        $this->assertArrayHasKey('weight', $responseString['errors']['meta']);
        $this->assertArrayHasKey('base_experience', $responseString['errors']['meta']);
        $this->assertArrayHasKey('order', $responseString['errors']['meta']);
        $this->assertArrayHasKey('is_default', $responseString['errors']['meta']);
    }

    public function test_is_default_is_boolean_when_updating()
    {
        Sanctum::actingAs($user = User::factory()->create(),['*']);

        $pokemon = Pokemon::factory()->create();

        $response = $this->put('api/pokemons/' . $pokemon->id,[
            'identifier' => 'warturtle',
            'species_id' => 6,
            'height' => 7,
            'weight' => 8,
            'base_experience' => 9,
            'order' => 10,
            'is_default' => 3
        ]);

        $responseString = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('is_default', $responseString['errors']['meta']);
    }
}
