<?php

namespace App;

use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use App\Traits\DatesTranslator;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Presenters\Category\UrlPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Category extends Model
{
    use SoftDeletes, HasSlug, FindSlug, DatesTranslator, SoftCascadeTrait;

	protected $fillable = [
	    'name', 'slug'
    ];

    protected $appends = [
        'url'
    ];

    protected $softCascade = ['posts'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute()
    {
        return new UrlPresenter($this);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}