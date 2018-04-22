<?php

namespace App\Presenters\Post;

use App\Post;

class UrlPresenter
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
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
        return route('posts.destroy', $this->post);
    }

    public function edit()
    {
        return route('posts.edit', $this->post);
    }

    public function show()
    {
        return route('posts.show', $this->post);
    }

    public function update()
    {
        return route('posts.update', $this->post);
    }

    public function restore()
    {
        return route('posts.restore', $this->post);
    }

    public function kill()
    {
        return route('posts.kill', $this->post);
    }
}