<?php

namespace App;

use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use softDeletes, HasSlug, FindSlug;

	protected $fillable = ['tag', 'slug'];

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('tag')
            ->saveSlugsTo('slug');
    }
}
