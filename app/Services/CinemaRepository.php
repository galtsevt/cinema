<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Person;
use Illuminate\Support\Facades\Http;

class CinemaRepository
{
    public function top()
    {
        $url = 'https://kinobd.net/api/films/top';
        return $this->getData($url);
    }

    public function search(string $search)
    {
        $url = 'https://kinobd.net/api/films/search/title?q=' . urlencode($search);
        $response = Http::get($url);
        return json_decode($response->body(), true);
    }

    private function getData(string $url)
    {
        $response = Http::get($url);
        $result = json_decode($response->body(), true);

        foreach ($result['data'] as $item) {
            $ids[] = $item['kinopoisk_id'];
        }
        if (isset($ids)) {
            $films = Film::query()->whereIn('kinopoisk_id', $ids)->get();
        }

        foreach ($result['data'] as $item) {
            if (isset($films) && ($film = $films->where('kinopoisk_id', $item['kinopoisk_id'])->first())) {
                $filmsData[] = $film;
            } else {
                $filmsData[] = $this->saveFilm($item);
            }
        }
        $result['data'] = $filmsData ?? null;
        return $result;
    }

    public function saveFilm(array $film): Film
    {
        $filmModel = new Film($film);
        $filmModel->loadImage($film['small_poster'], 'poster', false);
        $filmModel->save();
        $this->saveGenres($film['genres'], $filmModel);
        $this->saveCountries($film['countries'], $filmModel);
        $this->savePeople($film['persons'], $filmModel);
        return $filmModel;
    }

    private function saveGenres(?array $genres, Film &$film): void
    {
        if (isset($genres)) {
            foreach ($genres as $genre) {
                $names[] = $genre['name_ru'];
            }
            $genresCollection = Genre::query()->whereIn('name_ru', $names)->get();
            foreach ($genres as $genre) {
                if (!$genreModel = $genresCollection->where('name_ru', $genre['name_ru'])->first()) {
                    $genreModel = new Genre($genre);
                }
                $film->genres()->save($genreModel);
            }
        }
    }

    private function saveCountries(?array $countries, Film &$film): void
    {
        if (isset($countries)) {
            foreach ($countries as $country) {
                $names[] = $country['name_ru'];
            }
            $countriesCollection = Country::query()->whereIn('name_ru', $names)->get();
            foreach ($countries as $country) {
                if (!$countryModel = $countriesCollection->where('name_ru', $country['name_ru'])->first()) {
                    $countryModel = new Country($country);
                }
                $film->countries()->save($countryModel);
            }
        }
    }

    private function savePeople(?array $people, Film &$film): void
    {
        if (isset($people)) {
            foreach ($people as $person) {
                $names[] = $person['kinopoisk_id'];
            }
            $peopleCollection = Person::query()->whereIn('kinopoisk_id', $names ?? [])->get();
            foreach ($people as $person) {
                if (!$personModel = $peopleCollection->where('kinopoisk_id', $person['kinopoisk_id'])->first()) {
                    $personModel = new Person($person);
                }
                $film->people()->save($personModel, [
                    'profession_id' => $person['profession']['profession_id']
                ]);
            }
        }
    }
}
