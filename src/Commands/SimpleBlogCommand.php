<?php

namespace Abr4xas\SimpleBlog\Commands;

use Illuminate\Console\Command;

class SimpleBlogCommand extends Command
{
    public $signature = 'simple-blog';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
