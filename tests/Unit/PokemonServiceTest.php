<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PokemonService;
use Illuminate\Support\Facades\Http;

class PokemonServiceTest extends TestCase
{
    /** @test */
    public function it_can_get_a_list_of_pokemons()
    {
        Http::fake([
            'pokeapi.co/api/v2/pokemon*' => Http::response(['results' => [['name' => 'pikachu']]], 200),
        ]);

        $service = new PokemonService();
        $pokemons = $service->getPokemons();

        Http::assertSent(function ($request) {
            return $request->url() == 'https://pokeapi.co/api/v2/pokemon?offset=0&limit=151';
        });

        $this->assertArrayHasKey('results', $pokemons);
        $this->assertCount(1, $pokemons['results']);
        $this->assertEquals('pikachu', $pokemons['results'][0]['name']);
    }

    /** @test */
    public function it_can_get_a_single_pokemon()
    {
        Http::fake([
            'pokeapi.co/api/v2/pokemon/pikachu' => Http::response(['name' => 'pikachu', 'id' => 25], 200),
        ]);

        $service = new PokemonService();
        $pokemon = $service->getPokemon('pikachu');

        Http::assertSent(function ($request) {
            return $request->url() == 'https://pokeapi.co/api/v2/pokemon/pikachu';
        });

        $this->assertArrayHasKey('name', $pokemon);
        $this->assertEquals('pikachu', $pokemon['name']);
        $this->assertEquals(25, $pokemon['id']);
    }
}
