<?php
namespace Abr4xas\SimpleBlog\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasArticle
{
    public function articles(): MorphMany
    {
        return $this->morphMany(\Abr4xas\SimpleBlog\Models\Article::class, 'author');
    }
}
