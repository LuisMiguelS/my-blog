<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Presenters\User\UrlPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const ADMIN_ROLE = "admin";
    const AUTHOR_ROLE = "autor";
    const READER_ROLE = "lector";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'url'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }


    public function getAvatarAttribute($avatar)
    {
        if (is_null($avatar)) {
            return asset('recursos/imagenes/profile-default.png');
        }

        return asset('storage/'.$avatar );
    }

    public function getUrlAttribute()
    {
        return new UrlPresenter($this);
    }

    public function isAdmin()
    {
        return $this->role === User::ADMIN_ROLE;
    }

    public function owns(Model $model, $foreignKey = 'user_id')
    {
        return $this->id === $model->$foreignKey;
    }

    public function beforeUpdate()
    {
        return $this->id === auth()->id() || $this->isAdmin();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
