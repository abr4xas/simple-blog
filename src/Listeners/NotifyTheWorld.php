<?php

namespace Abr4xas\SimpleBlog\Listeners;

use App\Services\BingApi;
use Illuminate\Support\Facades\Http;
use Abr4xas\SimpleBlog\Models\Article;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Abr4xas\SimpleBlog\Events\ArticlePublished;

class NotifyTheWorld
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticlePublished $event)
    {
        $this->doPing();
        $this->doBing($event->article->url->show);
    }

    /**
     * generateWebMention.
     *
     * @param string $source
     * @param string $target
     * @return void
     */
    private function generateWebMention(string $source, string $target)
    {
        Http::asForm()->post('https://webmention.io/angelcruz.dev/webmention', [
            'source' => $source,
            'target' => $target,
        ]);
    }

    /**
     * Undocumented function.
     *
     * @param string $source
     * @param int $id
     * @return void
     */
    public function updateTweetUrl(string $source, int $id)
    {
        Article::where('id', $id)
            ->update(['tweet_url' => $source]);
    }

    private function doPing()
    {
        try {
            (new \App\Services\Ping\SendTo())->all();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::info('ping: ' . $e->getMessage());
        }
    }

    private function doBing($url)
    {
        try {
            (new BingApi())->generate($url);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::info('bing: ' . $e->getMessage());
        }
    }
}
