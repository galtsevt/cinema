<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'kinopoisk_id',
        'imdb_id',
        'name_original',
        'name_russian',
        'year',
        'year_start',
        'year_end',
        'rating_kp',
        'rating_kp_count',
        'rating_imdb',
        'rating_imdb_count',
        'time_minutes',
        'age_restriction',
        'description',
        'slogan',
        'budget',
        'trailer',
        'type',
        'poster',
    ];

    public function getName()
    {
        return $this->name_russian ?? $this->name_original;
    }

    public function genresToString(): string
    {
        return implode(',', $this->genres->pluck('name_ru')->toArray());
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'film_people', 'film_id', 'person_id')
            ->withPivot('profession_id');
    }

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id', 'genre_id');
    }

    public function countries(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'film_country', 'film_id', 'country_id');
    }

}
