<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $pokemon['name'] ?? 'Pokemon Detail' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
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
                    <div class="md:w-1/3 flex flex-col items-center mb-6 md:mb-0">
                        <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="w-48 h-48 object-contain">

                        <!-- Rating Section -->
                        <div x-data="{ rating: {{ $userRating ?? 0 }}, hoverRating: 0 }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 w-full flex flex-col items-center">
                            <h3 class="text-xl font-bold mb-4">Rate this Pokemon</h3>
                            @auth
                                <form x-ref="ratingForm" action="{{ route('pokemon.rate', $pokemon['name']) }}" method="POST" class="flex flex-col items-center gap-4">
                                    @csrf
                                    <input type="hidden" name="image_url" value="{{ $pokemon['sprites']['front_default'] }}">

                                    <div class="flex space-x-1">
                                        <input type="hidden" name="rating" :value="rating" required>
                                        <template x-for="star in 5">
                                            <button type="button"
                                                @click="rating = star; $nextTick(() => $refs.ratingForm.submit())"
                                                @mouseover="hoverRating = star"
                                                @mouseleave="hoverRating = 0"
                                                class="focus:outline-none focus:scale-110 transition-transform duration-150">
                                                <svg class="w-8 h-8"
                                                    :class="{ 'text-yellow-400': star <= (hoverRating || rating), 'text-gray-400': star > (hoverRating || rating) }"
                                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        </template>

                                    </div>
                                </form>
                                @if(session('success'))
                                    <p class="text-green-600 font-semibold mt-2">{{ session('success') }}</p>
                                @endif
                                <div class="ml-2 text-gray-700 dark:text-gray-300 self-center" x-text="hoverRating || rating ? (hoverRating || rating) + ' / 5' : ''"></div>
                            @else
                                <p class="text-gray-700 dark:text-gray-300 text-center">
                                    Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-bold">log in</a> to rate.
                                </p>
                            @endauth
                        </div>
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


                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
