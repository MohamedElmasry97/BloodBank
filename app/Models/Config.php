<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ['icon', 'email', 'application_phone' , 'content' , 'instgram_url', 'twitter_url', 'youtube_url', 'googleplus_url', 'whatsapp_url'];
    protected $table = 'config';
    public $timestamps = true;
}
