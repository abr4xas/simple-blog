<?php
namespace Abr4xas\SimpleBlog\Services;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class CommonMark
{
    public static function convertToHtml($markdown, $languages = ['html', 'php', 'js', 'yaml', 'bash', 'xml'])
    {
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer($languages));
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer($languages));

        $commonMarkConverter = new MarkdownConverter($environment);

        return $commonMarkConverter->convertToHtml($markdown);
    }
}
