<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            PublisherSeeder::class,
            RoleSeeder::class,
            StaffSeeder::class,
            MemberSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,

            BorrowingSeeder::class,
            BorrowingDetailSeeder::class,
            FineSeeder::class,
        ]);
    }
}
