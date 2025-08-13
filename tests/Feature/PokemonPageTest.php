<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\PokemonService;
use Mockery;

class PokemonPageTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function home_page_displays_list_of_pokemons()
    {
        $mockService = Mockery::mock(PokemonService::class);
        $mockService->shouldReceive('getPokemons')
                    ->once()
                    ->andReturn(['results' => [
                        ['name' => 'bulbasaur', 'url' => 'https://pokeapi.co/api/v2/pokemon/1/'],
                        ['name' => 'charmander', 'url' => 'https://pokeapi.co/api/v2/pokemon/4/'],
                    ]]);

        $this->app->instance(PokemonService::class, $mockService);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('bulbasaur');
        $response->assertSee('charmander');
    }

    /** @test */
    public function pokemon_detail_page_displays_pokemon_details()
    {
        $mockService = Mockery::mock(PokemonService::class);
        $mockService->shouldReceive('getPokemon')
                    ->once()
                    ->with('pikachu')
                    ->andReturn([
                        'name' => 'pikachu',
                        'id' => 25,
                        'height' => 4,
                        'weight' => 60,
                        'sprites' => ['front_default' => 'http://example.com/pikachu.png'],
                        'types' => [['type' => ['name' => 'electric']]],
                        'abilities' => [['ability' => ['name' => 'static'], 'is_hidden' => false]],
                        'stats' => [['stat' => ['name' => 'hp'], 'base_stat' => 35]],
                    ]);

        $mockService->shouldReceive('getPokemons')
                    ->once()
                    ->andReturn(['results' => [
                        ['name' => 'charmander', 'url' => 'https://pokeapi.co/api/v2/pokemon/4/'],
                        ['name' => 'squirtle', 'url' => 'https://pokeapi.co/api/v2/pokemon/7/'],
                        ['name' => 'pikachu', 'url' => 'https://pokeapi.co/api/v2/pokemon/25/'],
                        ['name' => 'jigglypuff', 'url' => 'https://pokeapi.co/api/v2/pokemon/39/'],
                        ['name' => 'meowth', 'url' => 'https://pokeapi.co/api/v2/pokemon/52/'],
                    ]]);

        $this->app->instance(PokemonService::class, $mockService);

        $response = $this->get('/pokemon/pikachu');

        $response->assertStatus(200);
        $response->assertSee('pikachu');
        $response->assertSee('Electric');
        $response->assertSee('Static');
        $response->assertSee('Hp');
        $response->assertSee('35');
    }
}
