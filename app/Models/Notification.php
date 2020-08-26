<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title' , 'content'];
    protected $table = 'notifications';
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    public function donation()
    {
        return $this->belongsTo('App\Models\Donate');
    }
}
