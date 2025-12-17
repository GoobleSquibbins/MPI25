<?php

use App\Models\Book;
use Database\Seeders\DatabaseSeeder;
use App\Models\Genre;
use App\Models\Member;
use App\Models\Staff;
use App\Models\Borrowing;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Tambah Genre', function () {  
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/genres')
        ->click('create')
        ->type('name', 'Genre Baru')
        ->click('submit')
        ->assertSee('Genre Baru');
});

test('Hapus Genre', function () {
    $genre = Genre::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/genres')
        ->assertSee($genre->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='delete{$genre->id}']") 
        
        // Tambahkan asersi untuk memastikan data hilang
        ->assertDontSee($genre->name);
});

test('Edit Genre', function () {
    $genre = Genre::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/genres')
        ->assertSee($genre->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='edit{$genre->id}']") 
        ->type('name', '')
        ->type('name', 'Genre Baru')
        ->submit()
        ->assertSee('Genre Baru');
});