# Laravel package to handle a simple blog

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/abr4xas/simple-blog/run-tests?label=tests)](https://github.com/abr4xas/simple-blog/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require abr4xas/simple-blog
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Abr4xas\SimpleBlog\SimpleBlogServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Abr4xas\SimpleBlog\SimpleBlogServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

register custom middleware:

```php
// app/Http/Kernel.php
protected $routeMiddleware = [
    ...
	'is.live' => \Abr4xas\SimpleBlog\Middleware\Is\Live::class,
];
```
then in your `ArticleShowController` add this:

```php
public function __construct()
{
	$this->middleware(['is.live:article']);
}
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [angel cruz](https://github.com/abr4xas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
