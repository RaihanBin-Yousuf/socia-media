<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
    
        DB::table("posts")->insert([

            'user_id' => rand(1, 21),
            'description' => $faker->text(),
            'status' => rand(1, 3),

        ]);
    }
}
