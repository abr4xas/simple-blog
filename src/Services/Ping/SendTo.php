<?php

namespace Abr4xas\SimpleBlog\Services\Ping;

use Illuminate\Support\Facades\Http;

class SendTo
{
    public function pingOMatic()
    {
        // https://pingomatic.com/ping/?title=El+blog+de+Angel+Cruz&blogurl=https%3A%2F%2Fangelcruz.dev&rssurl=https%3A%2F%2Fangelcruz.dev%2Ffeed&chk_blogs=on&chk_feedburner=on&chk_tailrank=on&chk_superfeedr=on
        Http::asForm()->post('https://pingomatic.com/ping', [
            'title' => urlencode(config('app.name')),
            'blogurl' => urlencode(config('app.url')),
            'rssurl' => urlencode(url('feeds.main')),
            'chk_blogs' => 'on',
            'chk_feedburner' => 'on',
            'chk_tailrank' => 'on',
            'chk_superfeedr' => 'on',
        ]);
    }

    public function twingly()
    {
        $xml = '
		<?xml version="1.0"?>
		<methodCall>
			<methodName>weblogUpdates.ping</methodName>
			<params>
				<param>
					<value>' . config('app.name') . '</value>
				</param>
				<param>
					<value>' . config('app.url') . '</value>
				</param>
			</params>
		</methodCall>';

        Http::withHeaders([
            'Content-Type' => 'text/xml; charset=utf-8',
        ])->send('POST', 'https://rpc.twingly.com/', [
            'body' => $xml,
        ]);
    }

    public function all()
    {
        $this->pingOMatic();
        $this->twingly();
    }
}
