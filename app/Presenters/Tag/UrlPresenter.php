<?php

namespace App\Presenters\Tag;

use App\Tag;

class UrlPresenter
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
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
        return route('tags.destroy', $this->tag);
    }

    public function edit()
    {
        return route('tags.edit', $this->tag);
    }

    public function show()
    {
        return route('tags.show', $this->tag);
    }

    public function update()
    {
        return route('tags.update', $this->tag);
    }
}