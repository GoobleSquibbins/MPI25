<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 20) as $i) {
            $book = \App\Models\Book::create([
                'name' => $faker->sentence(3),
                'publisher_id' => \App\Models\Publisher::inRandomOrder()->first()->id,
                'year' => rand(1990, 2024),
                'total_copies' => rand(3, 15),
                'available_copies' => rand(1, 10),
            ]);

            $book->genres()->attach(
                \App\Models\Genre::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );

            $book->authors()->attach(
                \App\Models\Author::inRandomOrder()->take(rand(1, 2))->pluck('id')
            );
        }
    }
}
