<?php

use Database\Seeders\DatabaseSeeder;
use App\Models\Member;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Tambah Member', function () {  
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/members')
        ->click('create')
        ->type('name', 'Member Baru')
        ->type('address', 'Alamat')
        ->type('phone', '1234567890')
        ->type('email', 'email@gmail.com')
        ->click('submit')
        ->assertSee('Member Baru');
});

test('Hapus Member', function () {
    $member = Member::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/members')
        ->assertSee($member->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='delete{$member->id}']") 
        
        // Tambahkan asersi untuk memastikan data hilang
        ->assertDontSee($member->name);
});

test('Edit Member', function () {
    $member = Member::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/members')
        ->assertSee($member->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='edit{$member->id}']") 
        ->type('name', '')
        ->type('name', 'Member Baru')
        ->submit()
        ->assertSee('Member Baru');
});