<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PokedexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHomePageDisplaysPokemons()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertTitle('Pokedex')
                    ->assertSee('Bulbasaur');
        });
    }

    public function testPokemonDetailPageDisplaysDetails()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Pikachu')
                    ->assertPathIs('/pokemon/pikachu')
                    ->assertTitle('pikachu')
                    ->assertSee('Pikachu')
                    ->assertSee('Electric')
                    ->assertSee('Static')
                    ->assertSee('Hp:');
        });
    }

    public function testPokemonDetailNavigation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/pokemon/pikachu')
                    ->assertSee('Pikachu')
                    ->clickLink('Next')
                    ->assertPathIs('/pokemon/raichu')
                    ->assertTitle('raichu')
                    ->clickLink('Previous')
                    ->assertPathIs('/pokemon/pikachu')
                    ->assertTitle('pikachu')
                    ->clickLink('Back to List')
                    ->assertPathIs('/')
                    ->assertTitle('Pokedex');
        });
    }
}
