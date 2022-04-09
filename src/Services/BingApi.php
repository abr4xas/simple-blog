<?php

namespace Abr4xas\SimpleBlog\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class BingApi
{
    /**
     * Undocumented function.
     *
     * @param string $url
     * @return \Illuminate\Http\Client\Response
     */
    public function generate(string $url)
    {
        $apiKey = config()->get('simple-blog.bing_apikey');

        if (empty($apiKey)) {
            throw new Exception('Bing Api Key is empty');
        }

        $fullUrl = "https://www.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey={$apiKey}";

        return Http::post($fullUrl, [
            'siteUrl' => config('app.url'),
            'urlList' => [
                $url,
            ],
        ]);
    }
}
