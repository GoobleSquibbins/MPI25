<?php

use Database\Seeders\DatabaseSeeder;
use App\Models\Publisher;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Tambah Publisher', function () {  
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/publishers')
        ->click('create')
        ->type('name', 'Publisher Baru')
        ->click('submit')
        ->assertSee('Publisher Baru');
});

test('Hapus Publisher', function () {
    $pub = Publisher::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/publishers')
        ->assertSee($pub->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='delete{$pub->id}']") 
        
        // Tambahkan asersi untuk memastikan data hilang
        ->assertDontSee($pub->name);
});

test('Edit Publisher', function () {
    $pub = Publisher::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/publishers')
        ->assertSee($pub->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='edit{$pub->id}']") 
        ->type('name', '')
        ->type('name', 'Publisher Baru')
        ->submit()
        ->assertSee('Publisher Baru');
});