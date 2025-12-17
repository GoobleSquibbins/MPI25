<?php

use App\Models\Book;
use Database\Seeders\DatabaseSeeder;
use App\Models\Member;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('User can search and select member in new borrowing', function () {  
    $member = Member::first();
    $book = Book::first();
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->assertSee('Borrowings Log')
        ->click('borrow-button')
        ->click('member_id')
        ->select('member_id', $member->id)
        ->click('book-select')
        ->click('book-select', $member->id)
        ->click('submit-btn');   
});