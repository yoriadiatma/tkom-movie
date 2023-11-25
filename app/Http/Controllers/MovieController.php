<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function index()
    {

        $query = Movie::latest();
        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('sinopsis', 'like', '%' . request('search') . '%');
        }
        $movies = $query->paginate(6)->withQueryString();
        return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = Movie::find($id);
        return view('detail', compact('movie'));
    }
}
