<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            'self help',
            'business',
            'kids',
        ];

        foreach($data as $category){
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
