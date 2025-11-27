<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 30) as $i) {
            $borrowDate = $faker->dateTimeBetween('-2 months', 'now');
            $dueDate = (clone $borrowDate)->modify('+7 days');

            $statusChance = rand(1, 100);

            if ($statusChance <= 50) {
                $status = 'returned';
                $returnDate = (clone $borrowDate)->modify('+' . rand(1, 10) . ' days');
            } elseif ($statusChance <= 80) {
                $status = 'overdue';
                $returnDate = null;
            } else {
                $status = 'borrowed';
                $returnDate = null;
            }

            \App\Models\Borrowing::create([
                'member_id' => \App\Models\Member::inRandomOrder()->first()->id,
                'staff_id' => \App\Models\Staff::inRandomOrder()->first()->id,
                'borrow_date' => $borrowDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'status' => $status,
            ]);
        }
    }
}
