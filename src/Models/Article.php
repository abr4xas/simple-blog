<?php

namespace Abr4xas\SimpleBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Abr4xas\SimpleBlog\Traits\LiveAware;
use Abr4xas\SimpleBlog\Traits\Sluggable;
use Abr4xas\SimpleBlog\Traits\GenerateMarkDown;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use LiveAware;
    use Sluggable;
    use GenerateMarkDown;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'status',
        'file',
    ];

    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(\Abr4xas\SimpleBlog\Models\Category::class, 'category_id');
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
     * Undocumented function
     *
     * @return void
     * @psalm-suppress MissingParamType
     */
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['month'])) {
            if ($month = $filters['month']) {
                $query->whereMonth('created_at', \Carbon\Carbon::parse($month)->month);
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

            return \Illuminate\Support\Facades\Cache::remember($key, 86400, function () {
                return self::convertToHtml($this->body);
            });
        }

        if (app()->environment('local')) {
            return self::convertToHtml($this->body);
        }
    }
}
