<?php
namespace Abr4xas\SimpleBlog\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasArticle
{
    public function posts(): MorphMany
    {
        return $this->morphMany(Article::class, 'author');
    }
}
