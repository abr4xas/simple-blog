<?php

namespace Abr4xas\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
	use HasFactory;

	protected $fillable = [
        'title',
        'slug'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
