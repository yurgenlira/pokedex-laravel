<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index(PokemonService $pokemonService, Request $request)
    {
        $pokemons = $pokemonService->getPokemons();

        return view('pokemon.index', [
            'pokemons' => $pokemons['results'],
        ]);
    }

    public function show(PokemonService $pokemonService, $name)
    {
        $pokemon = $pokemonService->getPokemon($name);
        $allPokemons = $pokemonService->getPokemons()['results'];

        $currentIndex = -1;
        foreach ($allPokemons as $index => $p) {
            if ($p['name'] === $name) {
                $currentIndex = $index;
                break;
            }
        }

        $previousPokemon = null;
        if ($currentIndex > 0) {
            $previousPokemon = $allPokemons[$currentIndex - 1]['name'];
        }

        $nextPokemon = null;
        if ($currentIndex < count($allPokemons) - 1) {
            $nextPokemon = $allPokemons[$currentIndex + 1]['name'];
        }

        return view('pokemon.show', [
            'pokemon' => $pokemon,
            'previousPokemon' => $previousPokemon,
            'nextPokemon' => $nextPokemon,
        ]);
    }
}
