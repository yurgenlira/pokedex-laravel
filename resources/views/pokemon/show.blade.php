<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $pokemon['name'] ?? 'Pokemon Detail' }}</title>

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
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    @if ($previousPokemon)
                        <a href="{{ route('pokemon.show', $previousPokemon) }}" class="text-blue-500 hover:underline">Previous</a>
                    @else
                        <div></div>
                    @endif
                    <a href="{{ route('pokemon.index') }}" class="text-blue-500 hover:underline">Back to List</a>
                    @if ($nextPokemon)
                        <a href="{{ route('pokemon.show', $nextPokemon) }}" class="text-blue-500 hover:underline">Next</a>
                    @else
                        <div></div>
                    @endif
                </div>
                <h1 class="text-4xl font-bold text-center capitalize mb-6">{{ $pokemon['name'] }}</h1>

                <div class="flex flex-col md:flex-row items-center md:items-start">
                    <div class="md:w-1/3 flex justify-center mb-6 md:mb-0">
                        <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="w-48 h-48 object-contain">
                    </div>
                    <div class="md:w-2/3">
                        <h2 class="text-2xl font-semibold mb-4">Details</h2>
                        <p class="text-lg mb-2"><strong>Height:</strong> {{ $pokemon['height'] / 10 }} m</p>
                        <p class="text-lg mb-2"><strong>Weight:</strong> {{ $pokemon['weight'] / 10 }} kg</p>
                        <p class="text-lg mb-2"><strong>Types:</strong>
                            @foreach ($pokemon['types'] as $type)
                                <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-800 mr-2">{{ ucfirst($type['type']['name']) }}</span>
                            @endforeach
                        </p>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Abilities:</h3>
                        <ul class="list-disc list-inside">
                            @foreach ($pokemon['abilities'] as $ability)
                                <li class="text-lg">{{ ucfirst($ability['ability']['name']) }} @if($ability['is_hidden']) (Hidden) @endif</li>
                            @endforeach
                        </ul>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Stats:</h3>
                        <ul class="list-disc list-inside">
                            @foreach ($pokemon['stats'] as $stat)
                                <li class="text-lg"><strong>{{ ucfirst(str_replace('-', ' ', $stat['stat']['name'])) }}:</strong> {{ $stat['base_stat'] }}</li>
                            @endforeach
                        </ul>

                        <!-- Rating Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold mb-4">Rate this Pokemon</h3>
                            @auth
                                <form action="{{ route('pokemon.rate', $pokemon['name']) }}" method="POST" class="flex flex-col items-start gap-4">
                                    @csrf
                                    <input type="hidden" name="image_url" value="{{ $pokemon['sprites']['front_default'] }}">

                                    <div x-data="{ rating: 0, hoverRating: 0 }" class="flex space-x-1">
                                        <input type="hidden" name="rating" :value="rating" required>
                                        <template x-for="star in 5">
                                            <button type="button"
                                                @click="rating = star"
                                                @mouseover="hoverRating = star"
                                                @mouseleave="hoverRating = 0"
                                                class="focus:outline-none focus:scale-110 transition-transform duration-150">
                                                <svg class="w-8 h-8"
                                                    :class="{ 'text-yellow-400': star <= (hoverRating || rating), 'text-gray-300': star > (hoverRating || rating) }"
                                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        </template>
                                        <div class="ml-2 text-gray-500 dark:text-gray-400 self-center" x-text="hoverRating || rating ? (hoverRating || rating) + ' / 5' : 'Select rating'"></div>
                                    </div>

                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                        Submit Rating
                                    </button>
                                </form>
                                @if(session('success'))
                                    <p class="text-green-600 font-semibold mt-2">{{ session('success') }}</p>
                                @endif
                            @else
                                <p class="text-gray-600 dark:text-gray-400">
                                    Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to rate this Pokemon.
                                </p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
