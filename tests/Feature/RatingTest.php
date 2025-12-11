<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pokemon;
use App\Models\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_rate_pokemon()
    {
        $user = User::factory()->create();
        $pokemonName = 'pikachu';

        $response = $this->actingAs($user)
            ->post(route('pokemon.rate', $pokemonName), [
                'rating' => 4,
                'image_url' => 'http://example.com/pikachu.png',
            ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('pokemons', ['name' => $pokemonName]);
        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'rating' => 4,
        ]);
    }

    public function test_guest_cannot_rate_pokemon()
    {
        $response = $this->post(route('pokemon.rate', 'pikachu'), [
            'rating' => 5,
            'image_url' => 'http://example.com/pikachu.png',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('ratings', 0);
    }

    public function test_leaderboard_shows_top_rated_pokemon()
    {
        $user = User::factory()->create();
        $pokemon1 = Pokemon::create(['name' => 'pikachu', 'image_url' => 'img1']);
        $pokemon2 = Pokemon::create(['name' => 'charmander', 'image_url' => 'img2']);

        Rating::create(['user_id' => $user->id, 'pokemon_id' => $pokemon1->id, 'rating' => 5]);
        Rating::create(['user_id' => $user->id, 'pokemon_id' => $pokemon2->id, 'rating' => 3]);

        $response = $this->get(route('pokemon.leaderboard'));

        $response->assertStatus(200);
        $response->assertSee('pikachu');
        $response->assertSee('5.0');
    }
}
