<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['tag'];

    public function setNameAttribute($tag)
    {
        $this->attributes['tag'] = strtolower($tag);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }
}
