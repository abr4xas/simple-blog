<?php

namespace Abr4xas\SimpleBlog;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Abr4xas\SimpleBlog\SimpleBlog
 */
class SimpleBlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simple-blog';
    }
}
