<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\CinemaRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(SearchRequest $request, CinemaRepository $cinemaRepository): \Inertia\Response
    {
        //$data = $request->validated();
        $result = $cinemaRepository->top();
        return inertia('Index', [
            'films' => $result['data']
        ]);
    }
}
