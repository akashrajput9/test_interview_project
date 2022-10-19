<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $guarded = [];

    public static function boot(){
        parent::boot();
        static::createing(function($model){
            $prevPage = $this->where('book_id',$model->id)->orderBy("book_id","desc")->first();
            $model->page_no = $prevPage?$prevPage->book_id+1:1;
        });
    }


}
