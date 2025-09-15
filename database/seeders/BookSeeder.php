<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
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
        ]);
    }
}
