<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(env('FAKER_LOCALE', 'en_US'));

        for ($i = 0; $i < 15; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt(env('DEFAULT_USER_PASSWORD', 'Userpassword123')),
                'role_id' => 2,
            ]);
        }
    }
}
