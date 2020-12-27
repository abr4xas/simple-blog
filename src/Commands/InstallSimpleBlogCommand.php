<?php

namespace Abr4xas\SimpleBlog\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;


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

        $this->info('Migrating...');

        $this->call('migrate');


        if (! is_dir($directory = app_path('Http/Controllers/Front/Articles'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(__DIR__.'/../../stubs/Controllers'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Front/Articles/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });

    }
}
