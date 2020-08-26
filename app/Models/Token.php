<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable =[
        'token' ,
        'type',
    ];
    protected $table = 'tokens';


    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
