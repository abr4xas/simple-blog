<?php
namespace Abr4xas\SimpleBlog\Traits;

use Abr4xas\SimpleBlog\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasArticle
{
    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'author');
    }
}
