<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';
    protected $primaryKey = 'id_anuncio';
    public $timestamps = false;

    public function getBannerAttribute ()
    {
        if(is_null($this->image))
            return asset('front-end/images/placeholder/' . ($this->lateral == 1 ? '600x600.jpg' : '950x150.jpg'));

        return asset('storage/' . $this->image );
    }

    public function getCanShowAttribute ()
    {
        return ($this->mostrar == 1 && $this->estado == 1) ? true : false;
    }

    public function getUrlAttribute ()
    {
        return $this->link ?? '#';
    }
}
