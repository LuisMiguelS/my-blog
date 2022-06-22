<?php

namespace App;

use Carbon\Carbon;
use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use App\Traits\DatesTranslator;
use Spatie\Sluggable\SlugOptions;
use App\Presenters\Post\UrlPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\PageViewCounter\Traits\HasPageViewCounter;

class Post extends Model
{
	use SoftDeletes, HasSlug, FindSlug, DatesTranslator, HasPageViewCounter;

	const PUBLISHED = 'PUBLISHED';
	const DRAFT = 'DRAFT';
	const PENDING = 'PENDING';

	protected  $fillable = [
		'user_id', 'category_id', 'title', 'seo_title', 'excerpt', 'body', 'slug', 'image',
        'meta_description', 'meta_keywords', 'status'
	];

	protected $dates = ['deleted_at'];

    protected $appends = [
        'url'
    ];

    /*
     *  Mutator
     */

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = strtolower($title);;
    }

    /*
     * Accessor
     */

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

    /*
     *  Methods
     */

    public function postInCategory($category_slug)
    {
        return $this->category->slug === $category_slug;
    }

    public function isPublished()
    {
        return $this->status === Post::PUBLISHED;
    }

    /*
     *  Relationships
     */

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

    /*
     * Query Local Scope
     */

    public static function archives()
    {
        return static::selectRaw("
            year(created_at) year,
            count(*) published,
            MONTHNAME(created_at) month,
            CASE
                WHEN MONTH(created_at) = 1 THEN 'Enero'
                WHEN MONTH(created_at) = 2 THEN 'Febrero'
                WHEN MONTH(created_at) = 3 THEN 'Marzo'
                WHEN MONTH(created_at) = 4 THEN 'Abril'
                WHEN MONTH(created_at) = 5 THEN 'Mayo'
                WHEN MONTH(created_at) = 6 THEN 'Junio'
                WHEN MONTH(created_at) = 7 THEN 'Julio'
                WHEN MONTH(created_at) = 8 THEN 'Agosto'
                WHEN MONTH(created_at) = 9 THEN 'Septiembre'
                WHEN MONTH(created_at) = 10 THEN 'Octubre'
                WHEN MONTH(created_at) = 11 THEN 'Noviembre'
                WHEN MONTH(created_at) = 12 THEN 'Diciembre'
            END mes
        ")
            ->groupBy('year', 'month', 'mes')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function scopeFilter($query, $filters)
    {
        if ($month = $filters[0]) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters[1]) {
            $query->whereYear('created_at', $year);
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search == null) {
            return $query;
        }
        return $query->where('title', 'like', '%'. $search .'%');
    }

    public function scopeCountPost($query, $status)
    {
        return $query->where('status', $status)->count();
    }

    public function scopeTypeRole($query)
    {
        return $query->unless(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(), function($q) {
            $q->where('user_id', auth()->id());
        });
    }

    public function scopePublished($query)
    {
        return $query->with(['user:id,name', 'category:id,slug', 'tags:id,tag'])
            ->where('status', Post::PUBLISHED)
            ->orderBy('id','DESC')
            ->paginate(15);
    }

    public function scopeDraft($query)
    {
        return $query->with(['user:id,name'])
            ->where('status', Post::DRAFT)
            ->where('user_id', auth()->id())
            ->orderBy('id','DESC')
            ->paginate(15);
    }

    public function scopeTrashs($query)
    {
        return $query->with(['user:id,name'])
            ->onlyTrashed()
            ->orderBy('id','DESC')
            ->paginate(15);
    }

    public function scopeFindTrash($query, $id)
    {
        return $query->withTrashed()
            ->where('id', $id)
            ->firstOrFail();
    }

}
