<?php

use Illuminate\Support\Str;

test('it can generate markdown text', function () {
    $string = '## hello world this is a test';

    $this->assertSame("<h2>hello world this is a test</h2>\n", Str::markdown($string));
});
