<p align="center">
	<img src="simple-blog.png" width="1028">
</p>


# Laravel package to handle a simple blog

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/abr4xas/simple-blog/Tests/master?label=Tests&style=flat-square)](https://github.com/abr4xas/simple-blog/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)


## Installation

You can install the package via composer:

```bash
composer require abr4xas/simple-blog // php 8
composer require abr4xas/simple-blog:2.X // php 7.X

```

You can publish and run the migrations and everything else with:

```bash
php artisan vendor:publish --provider="Abr4xas\SimpleBlog\SimpleBlogServiceProvider" --tag="simpleblog-migrations"
php artisan migrate

php artisan vendor:publish --provider="Abr4xas\SimpleBlog\SimpleBlogServiceProvider" --tag="simpleblog-controllers"
```

## Usage

This package uses a polymorphic relationship to associate the Items model with the model of your choice, the only thing you have to do is add the following trait: `Abr4xas\SimpleBlog\Traits\HasArticle` to the model you want to use.

### Syntax highlighting

See this: https://highlightjs.org/

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
