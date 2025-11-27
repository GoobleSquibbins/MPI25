<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
}
