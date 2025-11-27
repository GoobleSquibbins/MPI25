<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingDetailSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $borrowings = \App\Models\Borrowing::all();

        foreach ($borrowings as $borrowing) {
            $bookCount = rand(1, 3);

            $books = \App\Models\Book::inRandomOrder()->take($bookCount)->get();

            foreach ($books as $book) {
                $qty = rand(1, 2);

                $status = $borrowing->status === 'returned'
                    ? 'returned'
                    : 'borrowed';

                \App\Models\BorrowingDetail::create([
                    'borrow_id' => $borrowing->id,
                    'book_id' => $book->id,
                    'qty' => $qty,
                ]);

                $book->available_copies = max(0, $book->available_copies - $qty);
                $book->save();
            }
        }
    }
}
