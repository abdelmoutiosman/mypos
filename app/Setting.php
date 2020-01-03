<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about_app', 'facebook_url', 'twitter_url', 'instagram_url');
}
