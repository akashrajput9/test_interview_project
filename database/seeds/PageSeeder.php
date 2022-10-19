<?php

use App\Book;
use App\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $books = Book::get();
        foreach($books as $book){
            $book->pages()->create([
                'name' => Str::random(40),
            ]);

        }
    }
}
