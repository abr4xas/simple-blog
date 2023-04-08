<?php

namespace Abr4xas\SimpleBlog\Models;

use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
use Abr4xas\SimpleBlog\Traits\LiveAware;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\User
 *
 * @property string $body
 * @property string $status
 * @property mixed $id
 *
 * @method static where(string $string, string $string1, mixed $postId)
 * @method static whereId($max)
 */
class Article extends Model
{
    use HasFactory;
    use LiveAware;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'status',
        'file',
        'slug',
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
    ];

    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Undocumented function
     *
     * @psalm-suppress MissingReturnType
     * @psalm-suppress MissingClosureReturnType
     */
    public function content()
    {
        if (app()->environment('production')) {
            $key = 'article_'.$this->id.'_'.hash('md5', $this->body);

            return Cache::remember($key, 86400, function () {
                return str()->markdownsb($this->body);
            });
        }

        if (app()->environment('local')) {
            return str()->markdownsb($this->body);
        }
    }
}
