<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood_Type extends Model
{
    protected $fillable = ['name'];

    protected $table = 'blood_types';
    public $timestamps = true;

    public function DonateBloodType()
    {
        return $this->hasMany('App\Models\Donate');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function client()
    {
        return $this->hasOne('App\Models\Client');
    }
}
