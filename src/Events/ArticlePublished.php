<?php

namespace Abr4xas\SimpleBlog\Events;

use Illuminate\Broadcasting\Channel;
use Abr4xas\SimpleBlog\Models\Article;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticlePublished
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}
