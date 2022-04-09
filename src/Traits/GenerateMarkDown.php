<?php

namespace Abr4xas\SimpleBlog\Traits;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;
use SimonVomEyser\CommonMarkExtension\LazyImageExtension;
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
        $environment = new Environment(self::configEnv());

        $environment->addExtension(new CommonMarkCoreExtension());

        if (! empty(config()->get('torchlight.token'))) {
            $environment->addExtension(new TorchlightExtension());
        }

        $environment->addExtension(new AutolinkExtension());

        $environment->addExtension(new ExternalLinkExtension());

        $environment->addExtension(new AttributesExtension());

        $environment->addExtension(new LazyImageExtension());

        $environment->addExtension(new TaskListExtension());

        return (new MarkdownConverter($environment))
            ->convert($markdown);
    }

    private static function configEnv()
    {
        return [
            'external_link' => [
                'internal_hosts' => config('app.url'),
                'open_in_new_window' => true,
                'html_class' => 'underline',
                'nofollow' => '',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
        ];
    }
}
