<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return inertia('Index', [
            'films' => FilmResource::collection(
                Film::query()->inRandomOrder()->paginate(30)),
        ]);
    }
}
