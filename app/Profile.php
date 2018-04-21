<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
		'user_id', 'avatar', 'about', 'facebook', 'youtube'
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getAvatarAttribute($avatar)
    {
        if (is_null($avatar)) {
            return asset('recursos/imagenes/profile-default.png');
        }

        return asset('storage/'.$avatar );
    }
}
