<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Activity;
use App\Models\User;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(env('FAKER_LOCALE', 'en_US'));

        $users = User::all();

        for ($i = 1; $i <= 3; $i++) {
            $activity = new Activity([
                'activity_id' => sprintf('ACT-%04d', $i),
                'activity_name' => $faker->sentence,
                'responsible_person' => $faker->randomElement($users)->name,
                'activity_description' => $faker->text(200),
                'activity_budget' => $faker->numberBetween(100000, 10000000),
                'activity_status' => $faker->randomElement(['PENDING', 'REJECTED', 'APPROVED', 'COMPLETED']),
                'activity_location' => $faker->streetAddress(),
                'activity_start_date' => $faker->dateTimeThisYear(),
                'activity_end_date' => $faker->dateTimeBetween('now', '+5 months'),
                'document_name' => $faker->optional()->word(),
            ]);

            $activity->save();
        }
    }
}
