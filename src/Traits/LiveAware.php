<?php

namespace Abr4xas\SimpleBlog\Traits;

use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Builder;

trait LiveAware
{
    /**
     * Undocumented function
     *
     * @param Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLive(Builder $builder)
    {
        return $builder->where('status', '=', ArticleStatus::PUBLISHED());
    }
}
