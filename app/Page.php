<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $guarded = [];

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $prevPage = $model->where('book_id',$model->book->id)->orderBy("book_id","desc")->first();
            $model->page_no = $prevPage?$prevPage->book_id+1:1;
        });
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }


}
