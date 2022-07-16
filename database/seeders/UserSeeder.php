<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $data = [];
        for ($i = 0; $i <= 20; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'username' => $faker->userName(),
                'email' => $faker->unique()->safeEmail(),
                'address' => $faker->address(),
                'mobile' => $faker->phoneNumber(),
                'status' => $faker->numberBetween($min = 0, $max = 2),
                'password'          => Hash::make('123123123'), // password
                'email_verified_at' => now(),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }
        DB::table("users")->insert($data);
    }
}
