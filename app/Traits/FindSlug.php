<?php

namespace App\Traits;

trait FindSlug
{
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }
}