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
     * @return Builder
     */
    public function scopeLive(Builder $builder): Builder
    {
        return $builder->where('status', '=', ArticleStatus::PUBLISHED());
    }
}
