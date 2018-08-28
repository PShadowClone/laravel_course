<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); // factory pattern
        foreach (range(0, 50) as $index) {
            $image = $faker->image(public_path('image'));
            $image = str_replace(public_path(), '', $image);
            Book::create([
                'title' => $faker->title,
                'publisher' => $faker->name,
                'writer' => $faker->firstName,
                'isbn' => $faker->isbn10,
                'publish_time' => $faker->dateTime,
                'author' => $faker->name,
                'image' => $image
            ]);

        }
    }
}
