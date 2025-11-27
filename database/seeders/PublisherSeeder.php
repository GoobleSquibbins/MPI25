<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        $publishers = ['Gramedia', 'HarperCollins', 'Penguin', 'O’Reilly', 'Shueisha'];

        foreach ($publishers as $p) {
            \App\Models\Publisher::create(['name' => $p]);
        }
    }
}
