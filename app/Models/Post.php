<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title' , 'data'  , 'image' , 'category_id'];
    protected $table = 'posts';
    public $timestamps = true;

    public function Category()
    {
        return $this->belongsTo('App\Models\Cate');
    }
    public function client()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}
