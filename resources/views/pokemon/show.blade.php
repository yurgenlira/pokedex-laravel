<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $pokemon['name'] ?? 'Pokemon Detail' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('pokemon.index') }}" class="text-blue-500 hover:underline">Back to List</a>
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
