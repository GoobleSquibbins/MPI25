<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['publisher', 'genres', 'authors'])
            ->where('available_copies', '>', 0)
            ->get();

        return view('books.books', ['book_data' => $books]);
    }

    public function create()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.create', compact('publishers', 'authors', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0|lte:total_copies',
            'authors' => 'nullable|array',
            'authors.*' => 'exists:authors,id',
            'new_authors' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'new_genres' => 'nullable|string',
        ]);

        // Collect author IDs from selected and new
        $authorIds = $request->authors ?? [];

        if ($request->new_authors) {
            $newAuthorNames = array_map('trim', explode(',', $request->new_authors));
            foreach ($newAuthorNames as $name) {
                if (!empty($name)) {
                    $author = Author::firstOrCreate(['name' => $name]);
                    $authorIds[] = $author->id;
                }
            }
        }

        // Collect genre IDs from selected and new
        $genreIds = $request->genres ?? [];

        if ($request->new_genres) {
            $newGenreNames = array_map('trim', explode(',', $request->new_genres));
            foreach ($newGenreNames as $name) {
                if (!empty($name)) {
                    $genre = Genre::firstOrCreate(['name' => $name]);
                    $genreIds[] = $genre->id;
                }
            }
        }

        // Ensure at least one author and one genre
        if (empty($authorIds)) {
            return back()->withErrors(['authors' => 'At least one author is required.']);
        }
        if (empty($genreIds)) {
            return back()->withErrors(['genres' => 'At least one genre is required.']);
        }

        $book = Book::create([
            'name' => $request->name,
            'publisher_id' => $request->publisher_id,
            'year' => $request->year,
            'total_copies' => $request->total_copies,
            'available_copies' => $request->available_copies,
        ]);

        $book->authors()->attach($authorIds);
        $book->genres()->attach($genreIds);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }
}
