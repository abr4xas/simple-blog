<?php
namespace Abr4xas\SimpleBlog\Traits;

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
        return $builder->whereStatus('PUBLISHED');
    }

    public function isLive(): bool
    {
        return $this->status === 'PUBLISHED';
    }

    public function isNotLive(): bool
    {
        return ! $this->isLive();
    }
}
