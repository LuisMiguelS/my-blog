<?php

namespace App;

use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Presenters\Tag\UrlPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use softDeletes, HasSlug, FindSlug;

	protected $fillable = ['tag', 'slug'];

    protected $appends = [
        'url'
    ];

    public function setTagAttribute($tag)
    {
        $this->attributes['tag'] = strtolower($tag);
    }

    public function getTagAttribute($tag)
    {
        return ucwords($tag);
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
            ->generateSlugsFrom('tag')
            ->saveSlugsTo('slug');
    }

    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }
}
