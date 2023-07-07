<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->getName(),
            'rating_kp' => $this->rating_kp,
            'rating_imdb' => $this->rating_imdb,
            'age_restriction' => $this->age_restriction,
            'small_poster' => $this->getImageFull('poster'),
            'description' => $this->description,
            'slogan' => $this->slogan,
            'budget' => $this->budget,
            'trailer' => $this->trailer,
            'type' => $this->type,
            'year' => $this->year,
            'genres_string' => $this->genresToString(),
        ];
    }
}
