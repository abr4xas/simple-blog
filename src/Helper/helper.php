<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('suggestKeyword')) {
    /**
     * Undocumented function
     */
    function suggestKeyword(string $param): array
    {
        $keywords = [];
        $url = 'https://suggestqueries.google.com/complete/search?output=firefox&client=firefox&q='.urlencode($param);
        $response = Http::get($url);
        $jsonData = $response->json();
        if (($data = $jsonData) !== null) {
            $keywords = $data[1];
        }

        return $keywords;
    }
}
