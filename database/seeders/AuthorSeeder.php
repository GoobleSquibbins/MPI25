<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            'J.K. Rowling',
            'J.R.R. Tolkien',
            'Isaac Asimov',
            'Stephen King',
            'Agatha Christie',
        ];

        foreach ($authors as $a) {
            \App\Models\Author::create(['name' => $a]);
        }
    }
}
