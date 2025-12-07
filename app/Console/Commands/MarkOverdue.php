<?php

namespace App\Console\Commands;

use App\Models\Borrowing;
use Illuminate\Console\Command;

class MarkOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Borrowing::query()
            ->whereNull('return_date')
            ->whereDate('due_date', '<', today())   // date-only safe!
            ->update(['status' => 'overdue']);
    }
}
