<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    //
    protected $guarded = [];


    public static function boot(){
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::user();
           $model->created_by = $user->id;
           $model->updated_by = $user->id;
       });
       static::updating(function($model)
       {
           $user = Auth::user();
           $model->updated_by = $user->id;
       });
   }


    public function categories(){
       return $this->belongsToMany(Category::class,CategoryBook::class);
    }
    public function pages(){
        return $this->hasMany(Page::class,'book_id','id');
    }
}
