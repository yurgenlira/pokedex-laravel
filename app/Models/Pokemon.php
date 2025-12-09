<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'image_url',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
