<?php

namespace Abr4xas\SimpleBlog\Traits;

use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Output\RenderedContentInterface;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

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

        if (!empty(config()->get('TORCHLIGHT_TOKEN'))) {
            $environment->addExtension(new TorchlightExtension);
        }

        $environment->addExtension(new AttributesExtension());

        return (new MarkdownConverter($environment))
            ->convert($markdown);
    }
}
