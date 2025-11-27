<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = ['Fantasy', 'Sci-Fi', 'Mystery', 'Romance', 'Horror', 'Non-Fiction'];

        foreach ($genres as $g) {
            \App\Models\Genre::create(['name' => $g]);
        }
    }
}

