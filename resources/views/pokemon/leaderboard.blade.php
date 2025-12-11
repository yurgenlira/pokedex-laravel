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
                <div class="space-x-4 flex items-center">
                    <a href="{{ route('pokemon.leaderboard') }}" class="text-blue-500 hover:text-blue-700">Leaderboard</a>
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div x-show="open" @click.outside="open = false"
                                class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none"
                                style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('Log Out') }}</a>
                                </form>
                            </div>
                        </div>
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
