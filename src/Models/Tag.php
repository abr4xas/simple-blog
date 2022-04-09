<?php

namespace Abr4xas\SimpleBlog\Models;

use Abr4xas\SimpleBlog\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title', 'slug',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(\Abr4xas\SimpleBlog\Models\Article::class);
    }
}
