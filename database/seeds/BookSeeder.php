<?php

use App\Book;
use App\Category;
use App\CategoryBook;
use App\http\Helpers\AuthHelper;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AuthHelper::setDefaultAuth();

        foreach(Category::get() as $category){

            $category->books()->create([
                "book_name" => "7 Habits of highly effective people",
                "author_name" => "Stephen R. Covey",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        // Book::firstOrCreate([
        //     "book_name" => "Rich Dad Poor Dad",
        //     "author_name" => "Robert T Kiosaki",
        // ]);
    }
}
