<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return view('genres.genres', ['genre_data' => $genres]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $genre_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create([
            'name' => $genre_data['name'],
        ]);

        return redirect(route('genres.index'))->with('success', 'Genre Added Succesfully, Glory to mankind');
    }

    public function edit($genreid)
    {
        $genre_data = Genre::FindOrFail($genreid);

        return view('genres.edit', ['genre_data' => $genre_data]);
    }

    public function update(Request $request, $genreid)
    {
        $genre_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::findOrFail($genreid);

        $genre->update([
            'name' => $genre_data['name'],
        ]);

        return redirect(route('genres.index'))
            ->with('success', 'Genre Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Genre::findOrFail($request->id);

        $item->delete();

        return redirect(route('genres.index'))->with('success', 'Genre Deleted');
    }
}
