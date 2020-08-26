<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Government extends Model
{

    protected $fillable = ['name'];
    protected $table = 'governments';
    public $timestamps = true;

    public function city()
    {
        return $this->hasMany('App\Models\City');
    }
    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
