<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getPokemons()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon', [
            'offset' => 0,
            'limit' => 151,
        ]);

        return $response->json();
    }

    public function getPokemon($name)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        return $response->json();
    }
}
