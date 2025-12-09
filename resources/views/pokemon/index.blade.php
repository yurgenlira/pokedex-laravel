<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Pokedex' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('pokemon.index') }}" class="text-3xl font-bold text-gray-800 dark:text-white">Pokedex</a>
                <div class="space-x-4">
                    <a href="{{ route('pokemon.leaderboard') }}" class="text-blue-500 hover:text-blue-700">Leaderboard</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Log in</a>
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Register</a>
                    @endauth
                </div>
            </div>

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
