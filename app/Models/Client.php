<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'password', 'email', 'birthdate', 'phone', 'donation_last_date', 'is-active', 'city_id', 'blood_type_id', 'pin_code'];
    protected $table = 'clients';
    public $timestamps = true;
    protected $hidden = [
        'password', 'api_token'
    ];

    public function requests()
    {
        return $this->hasMany('App\Models\Donate');
    }

    public function governments()
    {
        return $this->belongsToMany('App\Models\Government');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('is_read');
    }

    public function post_favourite()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\Blood_Type', 'blood_type_client', 'client_id', 'blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    // public function blood_Type()
    // {
    //     return $this->belongsTo('App\Models\Blood_Type');
    // }
}
