<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = ['name' , 'government_id'];
    protected $table = 'cities';
    public $timestamps = true;

    public function government()
    {
        return $this->belongsTo('App\Models\Government');
    }

    public function donate()
    {
        return $this->hasMany('App\Models\Donate');
    }

}
