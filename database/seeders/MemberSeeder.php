<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Member::factory()->count(20)->create();
    }
}
