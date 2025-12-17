<?php

use Database\Seeders\DatabaseSeeder;
use App\Models\Author;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Tambah author', function () {  
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/authors')
        ->click('create')
        ->type('name', 'author Baru')
        ->submit()
        ->assertSee('author Baru');
});

test('Hapus author', function () {
    $author = Author::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/authors')
        ->assertSee($author->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='delete{$author->id}']") 
        
        // Tambahkan asersi untuk memastikan data hilang
        ->assertDontSee($author->name);
});

test('Edit author', function () {
    $author = Author::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/authors')
        ->assertSee($author->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='edit{$author->id}']") 
        ->type('name', '')
        ->type('name', 'author Baru')
        ->submit()
        ->assertSee('author Baru');
});