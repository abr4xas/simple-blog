<?php
namespace Abr4xas\SimpleBlog\Services;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class CommonMark
{
    public static function convertToHtml($markdown)
    {
        $languages = ['html', 'php', 'js', 'yaml', 'bash', 'xml'];

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer($languages));
        $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer($languages));

        $commonMarkConverter = new CommonMarkConverter([], $environment);

        return $commonMarkConverter->convertToHtml($markdown);
    }
}
