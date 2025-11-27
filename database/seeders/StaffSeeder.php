<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Staff::factory()->count(10)->create();
        \App\Models\Staff::create([
            'name' => 'admin',
            'password' => Hash::make('qwe'),
            'role_id' => 1,
        ]);
    }
}
