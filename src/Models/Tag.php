<?php

namespace Abr4xas\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
