<?php

namespace Abr4xas\SimpleBlog\Traits;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;
use Torchlight\Commonmark\V2\TorchlightExtension;

trait GenerateMarkDown
{
    /**
     * Undocumented function
     *
     * @param string $markdown
     * @return RenderedContentInterface
     */
    public static function convertToHtml(string $markdown): RenderedContentInterface
    {
        $environment = new Environment();

        $environment->addExtension(new CommonMarkCoreExtension());

        if (!empty(config()->get('torchlight.token'))) {
            $environment->addExtension(new TorchlightExtension());
        }

        $environment->addExtension(new AttributesExtension());

        return (new MarkdownConverter($environment))
            ->convert($markdown);
    }
}
