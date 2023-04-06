<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_id' => 1,
            'role_name' => 'Admin',
            'role_description' => 'Admin Role',
        ]);

        Role::create([
            'role_id' => 2,
            'role_name' => 'User',
            'role_description' => 'User Role',
        ]);
    }
}
