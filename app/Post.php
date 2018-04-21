<?php

namespace App;

use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Presenters\Post\UrlPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes, HasSlug, FindSlug;

	const PUBLISHED = 'PUBLISHED';
	const DRAFT = 'DRAFT';
	const PENDING = 'PENDING';

	protected  $fillable = [
		'user_id', 'category_id', 'title', 'seo_title', 'excerpt', 'body', 'slug', 'image', 'meta_description', 'meta_keywords', 'status'
	];

	protected $dates = ['deleted_at'];

    protected $appends = [
        'url'
    ];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);;
    }

    public function getTitleAttribute($title)
    {
        return ucwords($title);
    }

    public function getImageAttribute($image)
    {
        if (is_null($image)){
            return asset('recursos/imagenes/post-default.png');
        }
    	return asset('storage/'.$image);
    }

    public function getUrlAttribute()
    {
        return new UrlPresenter($this);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function isPublished()
    {
        return $this->status === Post::PUBLISHED;
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
