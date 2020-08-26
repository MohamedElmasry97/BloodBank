<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    protected $fillable = ['name', 'age', 'blood_type_id', 'no_bags', 'hospital_name', 'phone', 'city_id', 'note', 'longitude', 'latitude'];
    protected $table = 'donates';
    public $timestamps = true;

    public function client_donate()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\Blood_Type');
    }

    public function government()
    {
        return $this->hasOne('App\Models\ClientGovernment');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
}
