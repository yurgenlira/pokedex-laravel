<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Pokedex' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($pokemons as $pokemon)
                    <div class="bg-gray-200 rounded-lg p-4 flex flex-col items-center justify-center">
                        <a href="{{ route('pokemon.show', $pokemon['name']) }}">
                            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ explode('/', $pokemon['url'])[6] }}.png" alt="{{ $pokemon['name'] }}" class="mx-auto">
                            <p class="text-center mt-2">{{ ucfirst($pokemon['name']) }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
