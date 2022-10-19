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
            $prevPage = Page::where('book_id',$book->id)->orderBy("book_id","desc")->first();
            Page::create([
                'page_no' => $prevPage?$prevPage->id:1,
                'name' => Str::random(40),
            ]);

        }
    }
}
