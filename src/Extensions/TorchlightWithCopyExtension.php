<?php

namespace Abr4xas\SimpleBlog\Extensions;

use Closure;
use Torchlight\Block;
use Torchlight\Commonmark\V2\TorchlightExtension;

class TorchlightWithCopyExtension extends TorchlightExtension
{
    public function defaultBlockRenderer(): Closure
    {
        return function (Block $block) {
            $torchlight = parent::defaultBlockRenderer();

            return <<<HTML
                <div x-data="codeBlock" class="relative">
                    <div class="hidden lg:flex lg:space-x-2 lg:items-center absolute top-0 right-0 mr-3 mt-3">
                        <div x-cloak x-show="showMessage" x-transition class="animate-bounce transition duration-300 mt-1 text-teal-400 text-xs">Copied!</div>
                        <button
                            type="button"
                            title="Copy to clipboard"
                            class="hidden md:block transition duration-300"
                            @click.prevent="copyToClipboard"
                            :class="{
                                'text-white/30 hover:text-white/80': !showMessage,
                                'text-teal-400 hover:text-teal-400': showMessage,
                            }">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                        </button>
                    </div>
                    {$torchlight($block)}
                </div>
            HTML;
        };
    }
}
