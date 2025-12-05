<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return view('authors.authors', ['author_data' => $authors]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $author_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $author_data['name'],
        ]);

        return redirect(route('authors.index'))->with('success', 'Author Added Succesfully, Glory to mankind');
    }

    public function edit($authorid)
    {
        $author_data = Author::FindOrFail($authorid);

        return view('authors.edit', ['author_data' => $author_data]);
    }

    public function update(Request $request, $authorid)
    {
        $author_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($authorid);

        $author->update([
            'name' => $author_data['name'],
        ]);

        return redirect(route('authors.index'))
            ->with('success', 'Author Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Author::findOrFail($request->id);

        $item->delete();

        return redirect(route('authors.index'))->with('success', 'Author Deleted');
    }
}
