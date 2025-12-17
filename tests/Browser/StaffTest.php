<?php

use Database\Seeders\DatabaseSeeder;
use App\Models\Staff;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Tambah Staff', function () {  
    $this->visit('/')
        ->resize(1280, 720)
        ->assertSee('LIBRARY MANAGEMENT SYSTEM')
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/staffs')
        ->click('create')
        ->type('name', 'Staff Baru')
        ->type('password', 'pwd')
        ->type('password_conf', 'pwd')
        ->click('submit')
        ->type('search', 'Staff Baru')
        ->assertSee('Staff Baru');
});

test('Hapus Staff', function () {
    $staff = Staff::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/staffs')
        ->assertSee($staff->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='delete{$staff->id}']") 
        
        // Tambahkan asersi untuk memastikan data hilang
        ->assertDontSee($staff->name);
});

test('Edit Staff', function () {
    $staff = Staff::first();  
    $this->visit('/')
        ->resize(1280, 720)
        ->type('name', 'admin')
        ->type('password', 'qwe')
        ->submit()
        ->navigate('/staffs')
        ->assertSee($staff->name)
        
        // Gunakan kutip ganda dan selector [name]
        ->click("[name='edit{$staff->id}']") 
        ->type('name', '')
        ->type('name', 'Staff Baru')
        ->submit()
        ->assertSee('Staff Baru');
});