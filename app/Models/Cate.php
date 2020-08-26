<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $fillable = ['type'];
    protected $table = 'categories';
    public $timestamps = true;

}
