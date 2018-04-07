<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
	use softDeletes;

	protected  $fillable = [
		'title', 'content', 'thumbnails', 'category_id', 'slug', 'user_id', 'publish_at'
	];

	protected $dates = ['deleted_at'];


    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);
        $this->attributes['slug'] = str_slug($title, '-');
    }

    public function getTitleAttribute($title)
    {
        return ucwords($title);
    }

    public function getThumbnailsAttribute($thumbnails)
    {
    	return asset('storage/'.$thumbnails);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
