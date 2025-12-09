<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Leaderboard - Pokedex</title>
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

            <h1 class="text-3xl font-bold mb-6 text-center">Top 10 Rated Pokemon</h1>

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Rank</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Pokemon</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pokemons as $index => $ratedPokemon)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <p class="whitespace-no-wrap">{{ $index + 1 }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <a href="{{ route('pokemon.show', $ratedPokemon->pokemon->name) }}">
                                            <img class="w-full h-full rounded-full object-cover" src="{{ $ratedPokemon->pokemon->image_url }}" alt="{{ $ratedPokemon->pokemon->name }}" />
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <a href="{{ route('pokemon.show', $ratedPokemon->pokemon->name) }}" class="whitespace-no-wrap capitalize hover:underline">
                                            {{ $ratedPokemon->pokemon->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{ number_format($ratedPokemon->average_rating, 1) }}</span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
