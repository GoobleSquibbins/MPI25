<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FineSeeder extends Seeder
{
    public function run()
    {
        $overdueBorrowings = \App\Models\Borrowing::where('status', 'overdue')->get();

        foreach ($overdueBorrowings as $borrowing) {
            $borrowing->due_date = Carbon::parse($borrowing->due_date);
            // calc fine based on days late
            $daysLate = $borrowing->due_date->diffInDays(now(), false);
            $statusChance = rand(1, 100);
            if ($statusChance <= 50) {
                $status = 'paid';
            } elseif ($statusChance <= 80) {
                $status = 'pending';
            } else {
                $status = 'waived';
            }

            \App\Models\Fine::create([
                'borrow_id' => $borrowing->id,
                'amount' => $daysLate * 500, // Rp 500 per hari misalnya
                'status' => $status,
            ]);
        }
    }
}
