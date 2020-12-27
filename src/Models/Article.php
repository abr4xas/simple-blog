<?php

namespace Abr4xas\SimpleBlog\Models;

use Abr4xas\SimpleBlog\Traits\LiveAware;
use Abr4xas\SimpleBlog\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Article extends Model
{
    use HasFactory;
    use LiveAware;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
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
        return $this->belongsTo(\App\Models\Category::class);
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
        if (config('app.env') != 'local') {
            $key = 'article_'.$this->id.'_'.hash('md5', $this->body);

            return \Illuminate\Support\Facades\Cache::remember($key, 86400, function () {
                return \Sinnbeck\Markdom\Facades\Markdom::toHtml($this->body);
            });
        }

        return \Sinnbeck\Markdom\Facades\Markdom::toHtml($this->body);
    }
}
