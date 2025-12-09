<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pokemon;
use App\Models\Rating;

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


    public function rate(Request $request, $name)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'image_url' => 'required|string',
        ]);

        $pokemon = Pokemon::firstOrCreate(
            ['name' => $name],
            ['image_url' => $request->image_url]
        );

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'pokemon_id' => $pokemon->id,
            ],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Rating saved!');
    }

    public function leaderboard()
    {
        $topPokemons = Rating::select('pokemon_id', DB::raw('avg(rating) as average_rating'))
            ->groupBy('pokemon_id')
            ->orderByDesc('average_rating')
            ->take(10)
            ->with('pokemon')
            ->get();

        return view('pokemon.leaderboard', [
            'pokemons' => $topPokemons,
        ]);
    }
}
