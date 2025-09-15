<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $books = [
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'isbn' => '9780132350884',
                'publication_year' => 2008,
                'category' => 'Programming',
                'total_copies' => 5,
                'available_copies' => 3,
                'is_digital' => false,
                'digital_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt, David Thomas',
                'publisher' => 'Addison-Wesley',
                'isbn' => '9780201616224',
                'publication_year' => 1999,
                'category' => 'Programming',
                'total_copies' => 4,
                'available_copies' => 4,
                'is_digital' => true,
                'digital_url' => 'https://example.com/ebook/pragmatic-programmer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'publisher' => 'MIT Press',
                'isbn' => '9780262033848',
                'publication_year' => 2009,
                'category' => 'Computer Science',
                'total_copies' => 6,
                'available_copies' => 5,
                'is_digital' => false,
                'digital_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Generate 27 random books biar total 30
        for ($i = 0; $i < 27; $i++) {
            $total = $faker->numberBetween(1, 10);
            $available = $faker->numberBetween(0, $total);

            $books[] = [
                'title' => $faker->sentence(3),
                'author' => $faker->name(),
                'publisher' => $faker->company(),
                'isbn' => $faker->isbn13(),
                'publication_year' => $faker->year(),
                'category' => $faker->randomElement(['Programming', 'Computer Science', 'Mathematics', 'Literature', 'History']),
                'total_copies' => $total,
                'available_copies' => $available,
                'is_digital' => $faker->boolean(30), // 30% kemungkinan digital
                'digital_url' => $faker->boolean(30) ? $faker->url() : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('books')->insert($books);
    }
}
    