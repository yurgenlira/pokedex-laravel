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

        return view('pokemon.show', [
            'pokemon' => $pokemon,
        ]);
    }
}
