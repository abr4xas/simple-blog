<?php

namespace Abr4xas\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Abr4xas\SimpleBlog\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(\Abr4xas\SimpleBlog\Models\Article::class);
    }
}
