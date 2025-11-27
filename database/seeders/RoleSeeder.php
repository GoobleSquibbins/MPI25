<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Librarian', 'Assistant', 'Manager'];

        foreach ($roles as $r) {
            \App\Models\Role::create(['name' => $r]);
        }
    }
}
