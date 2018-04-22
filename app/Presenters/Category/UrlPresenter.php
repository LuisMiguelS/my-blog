<?php

namespace App\Presenters\Category;

use App\Category;

class UrlPresenter
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
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
        return route('categories.destroy', $this->category);
    }

    public function edit()
    {
        return route('categories.edit', $this->category);
    }

    public function show()
    {
        return route('categories.show', $this->category);
    }

    public function update()
    {
        return route('categories.update', $this->category);
    }
}