<?php

namespace Abr4xas\SimpleBlog\Commands;

use Illuminate\Console\Command;

class InstallSimpleBlogCommand extends Command
{
    public $signature = 'simpleblog:install';

    public $description = 'Install the simple blog package';

    public function handle(): void
    {
        $this->info('Installing...');

        $this->call('vendor:publish', [
            '--provider' => "Abr4xas\SimpleBlog\SimpleBlogServiceProvider",
            '--tag' => "migrations",
        ]);

        $this->call('migrate');

        $this->info('Installed...');
    }
}
