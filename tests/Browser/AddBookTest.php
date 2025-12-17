<?php

use App\Models\Book;
use Database\Seeders\DatabaseSeeder;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Member;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Nambah Buku', function () {
    $publisher = Publisher::first();
    $author = Author::first();
    $genre = Genre::first(); 
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/books')
        ->click('add-book')
        ->assertSee('Add New Book')
        ->type('name', 'Test Book')
        ->type('year', '2023')
        ->type('total_copies', '10')
        ->type('available_copies', '10')
        ->type('publisher-search', $publisher->name)
        ->waitForText($publisher->name) 
        ->click($publisher->name)
        ->select('author-select', $author->id)
        ->type('genre-search', $genre->name)
        ->waitForText($genre->name) 
        ->click($genre->name);
});