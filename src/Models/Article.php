<?php

namespace Abr4xas\SimpleBlog\Models;

use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
use Abr4xas\SimpleBlog\Traits\LiveAware;
use Abr4xas\SimpleBlog\Traits\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * App\Models\User
 *
 * @property string $body
 * @property string $status
 * @property mixed $id
 * @method static where(string $string, string $string1, mixed $postId)
 * @method static whereId($max)
 */
class Article extends Model
{
    use HasFactory;
    use LiveAware;
    use Sluggable;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'status',
        'file',
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
     * @return array
     */
    public function related(): array
    {
        $postId = $this->id;

        $min = self::where('id', '<', $postId)
                    ->live()
                    ->max('id');
        $max = self::where('id', '>', $postId)
                    ->live()
                    ->min('id');

        $previous = self::whereId($min)->first();
        $next = self::whereId($max)->first();

        return [
            'previous' => $previous,
            'next' => $next,
        ];
    }


    /**
     * @param Builder $query
     * @param array $filters
     * @psalm-suppress MissingParamType
     * @return void
     */
    public function scopeFilter($query, array $filters): void
    {
        if (isset($filters['month'])) {
            if ($month = $filters['month']) {
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
        }
        if (isset($filters['year'])) {
            if ($year = $filters['year']) {
                $query->whereYear('created_at', $year);
            }
        }
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
            $key = 'article_' . $this->id . '_' . hash('md5', $this->body);

            return Cache::remember($key, 86400, function () {
                return Str::markdown($this->body);
            });
        }

        if (app()->environment('local')) {
            return Str::markdown($this->body);
        }
    }


    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->status->equals(ArticleStatus::PUBLISHED());
    }
}
