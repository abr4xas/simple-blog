<?php

use Illuminate\Support\Str;

use League\CommonMark\Output\RenderedContentInterface;

test('it can generate markdown text', function () {
    $string = '## hello world this is a test';
    $content = Str::markdownsb($string);

    expect($content)->toBeInstanceOf(RenderedContentInterface::class);
});
