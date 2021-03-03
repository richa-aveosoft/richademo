<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Post::truncate();

        foreach (range(1, 10) as $a) {
            Post::create([
                'title'      =>  $faker->title,
                'description'   =>  $faker->text,
            ]);
        }
    }
}
