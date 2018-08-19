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
        $faker = Faker\Factory::create(); // factory pattern // hide creation operations
        foreach (range(0, 50) as $index) {
            $image = $faker->image(public_path('image'));
            $image = str_replace(public_path(), '', $image);
            Book::create([
                "title" => $faker->title,
                'author' => $faker->name,
                'writer' => $faker->userName,
                'publisher' => $faker->firstName,
                'publish_date' => $faker->date,
                'isbn' => $faker->isbn10,
                'image' => $image
            ]);
        }

    }
}
