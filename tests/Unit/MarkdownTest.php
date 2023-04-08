<?php

use League\CommonMark\Output\RenderedContentInterface;

test('it can generate markdown text', function () {
    $string = '## hello world this is a test';
    $content = str()->markdownsb($string);

    expect($content)->toBeInstanceOf(RenderedContentInterface::class);
});
