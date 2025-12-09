<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/leaderboard', [PokemonController::class, 'leaderboard'])->name('pokemon.leaderboard');
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::post('/pokemon/{name}/rate', [PokemonController::class, 'rate'])->middleware(['auth'])->name('pokemon.rate');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
