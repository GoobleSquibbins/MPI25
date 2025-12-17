<?php

use App\Models\Book;
use Database\Seeders\DatabaseSeeder;
use App\Models\Member;
use App\Models\Staff;
use App\Models\Borrowing;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Pinjam Buku', function () {  
    $member = Member::first();
    $book = Book::where('available_copies', '>', 0)->first();
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->assertSee('Borrowings Log')
        ->click('#borrow-button')
        ->select('member_id', $member->id)
        ->select('book-select', $book->id)
        ->type('borrow_date', now()->format('Y-m-d'))
        ->type('due_date', now()->addDays(7)->format('Y-m-d'))
        ->press('submit-btn')
        ->assertSee($member->name);
});

test('Kembalikan Buku', function () {
    $member = Member::first();
    $staff = Staff::first();
    $borrowing = Borrowing::create([
        'member_id' => $member->id,
        'staff_id' => $staff->id,
        'borrow_date' => now()->format('Y-m-d'),
        'due_date' => now()->addDays(7)->format('Y-m-d'),
        'status' => 'borrowed',
    ]);

    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->assertSee($member->name)
        ->click("back{$borrowing->id}")
        ->assertSee('returned')
        ->wait(3);
});