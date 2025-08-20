<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FacultyProfileSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('faculty_profile')->insert([
                'fname' => $faker->firstName,
                'mname' => $faker->optional()->firstName,
                'lname' => $faker->lastName,
                'extension' => $faker->optional()->word,
                'email' => $faker->unique()->safeEmail,
                'contact_no' => $faker->phoneNumber,
                'position' => $faker->randomElement(['Faculty', 'Adviser']),
                'department' => $faker->word,
                'region' => $faker->optional()->word,
                'province' => $faker->optional()->word,
                'city' => $faker->optional()->word,
                'barangay' => $faker->optional()->word,
                'street' => $faker->optional()->streetAddress,
                'zip_code' => $faker->optional()->postcode,
                'is_active' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
