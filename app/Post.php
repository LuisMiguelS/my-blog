<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
	//Usado para indicar la fecha en que fue eliminado un post
	use softDeletes;

	protected  $fillable = [
		'title', 'content', 'featured', 'category_id', 'slug', 'user_id'
	];

	protected $dates = ['deleted_at'];

	/*Este metodo indica la relacion que existe entre Category y Post
	  es por eso que aparece el metodo: 'public function category ()' en
	  este modelo de posts. _Un post puede tener una unica categoria.		
	*/
    public function category ()
    {
		return $this->belongsTo('App\Category');
    }

    public function tags ()
    {
		return $this->belongsToMany('App\Tag');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    //Accessors: esto generará un link con la imagen solicitada; algo como esto:
    //http://localhost/projects/Blog/public/uploads/posts/1514922555Plum SG_70.jpg
    public function getFeaturedAttribute($featured)
    {
    	return asset($featured);
    }
}
