<?php
namespace Abr4xas\SimpleBlog\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPost
{
    public function posts(): MorphMany
    {
        return $this->morphMany(Article::class, 'author');
    }
}
