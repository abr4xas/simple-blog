<?php
namespace Abr4xas\SimpleBlog\Traits;
use Illuminate\Database\Eloquent\Builder;


trait LiveAware
{
	public function scopeLive(Builder $builder)
	{
		return $builder->whereStatus('PUBLISHED');
	}

	public function isLive()
	{
		return $this->status === 'PUBLISHED';
	}

	public function isNotLive()
	{
		return !$this->isLive();
	}
}
