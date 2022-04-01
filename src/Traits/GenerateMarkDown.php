<?php

namespace Abr4xas\SimpleBlog\Traits;

use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;
use Abr4xas\SimpleBlog\CommonMarkExtension\LazyImageExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;

trait GenerateMarkDown
{
    public static function convertToHtml($markdown, $languages = ['html', 'php', 'js', 'yaml', 'bash', 'xml'])
    {
        $environment = new Environment(self::envConfig());

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TorchlightExtension);
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new LazyImageExtension());
        // $environment->addRenderer(FencedCode::class, new FencedCodeRenderer($languages));
        // $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer($languages));

        return (new MarkdownConverter($environment))
            ->convert($markdown);
    }

    private static function envConfig()
    {
        return [
            'lazy_image' => [
                'strip_src' => false, // remove the "src" to add it later via js, optional
                'html_class' => 'lozad', // the class that should be added, optional,
                'loading' => 'lazy',
            ],
        ];
    }
}
