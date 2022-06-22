<?php

namespace App\Presenters\User;

use App\User;

class UrlPresenter
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __get($key)
    {
        if(method_exists($this, $key))
        {
            return $this->$key();
        }

        return $this->$key;
    }

    public function delete()
    {
        return route('users.destroy', $this->user);
    }

    public function edit()
    {
        return route('users.edit', $this->user);
    }

    public function show()
    {
        return route('users.show', $this->user);
    }

    public function update()
    {
        return route('users.update', $this->user);
    }
}