<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'email', 'client_phone', 'content'];

    protected $table = 'settings';
    public $timestamps = true;
}
