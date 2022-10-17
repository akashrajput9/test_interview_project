<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $guarded = [];

    public function categories(){
        $this->belongsToMany(Category::class,CategoryBook::class);
    }
}
