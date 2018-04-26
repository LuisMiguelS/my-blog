<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
		'user_id', 'about', 'facebook', 'youtube', 'google_plus', 'instagram', 'twitter'
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
