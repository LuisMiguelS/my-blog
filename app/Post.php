<?php

namespace App;

use Carbon\Carbon;
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

    public function postInCategory($category_slug)
    {
        return $this->category->slug === $category_slug;
    }

    public function scopeFilter($query, $filters)
    {
        // Refactoring
        if ($month = $filters[0]) {

            $query->whereMonth('created_at', Carbon::parse($month)->month);

        }

        if ($year = $filters[1]) {

            $query->whereYear('created_at', $year);

        }

        return $query;
    }

    public static function archives()
    {
        return static::selectRaw("year(created_at) year, monthname(created_at) month, count(*) published")
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'. $search .'%');
    }

    public function scopePublished($query)
    {
        return $query->with(['user:id,name', 'category:id,slug', 'tags:id,tag'])
            ->where('status', Post::PUBLISHED)
            ->orderBy('id','DESC')
            ->paginate(15);
    }
}
