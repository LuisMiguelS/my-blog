<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/*Este metodo indica la relacion que existe entre Post y Category
	  es por eso que aparece el metodo: 'public function posts ()' en
	  este modelo de categorias. _Una categoria puede tener muchos posts.		
	*/
    public function posts ()
    {
    	return $this->hasMany('App\Post');
    }
}