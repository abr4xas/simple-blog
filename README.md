## Laravel package to handle a simple blog

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/abr4xas/simple-blog/run-tests.yml?style=flat-square)](https://github.com/abr4xas/simple-blog/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/abr4xas/simple-blog.svg?style=flat-square)](https://packagist.org/packages/abr4xas/simple-blog)


## Installation

You can install the package via composer:

```bash
composer require abr4xas/simple-blog
```

You can publish and run the migrations and everything else with:

```bash
php artisan vendor:publish --provider="Abr4xas\SimpleBlog\SimpleBlogServiceProvider" --tag="simple-blog-migrations"
php artisan migrate
```

## Usage

This package uses a polymorphic relationship to associate the Items model with the model of your choice, the only thing you have to do is add the following trait: `Abr4xas\SimpleBlog\Traits\HasArticle` to the model you want to use.


### To create an article you need to do something like this:

```php
$user->articles()->create([
    'title' => 'My first fake post',
    'slug' => 'my-first-post',
    'excerpt' => 'The excerpt of this fake post',
    'body' => 'The body of this fake post',
    'status' => ArticleStatus::PUBLISHED(), // ArticleStatus::DRAFT()
    'file' => 'https://i.pinimg.com/originals/4f/e7/06/4fe7066d4f3aa7201e38484230fc32b3.jpg',
]);
```


## Syntax highlighting

This package uses: [Torchlight](https://torchlight.dev/docs) CommonMark, so, you need an api key to make it work. Follow this docs: https://torchlight.dev/docs/clients/commonmark-php

### If you want to activate the copyable option to torchlight you need to do the following:

Edit your `config/torchlight.php` file to include the following in the options array:

```
'copyable' => true,
```

Next, make sure to register this javascript snippet inside your `app.js` file like this:

```js
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("codeBlock", () => ({
    showMessage: false,
    copyToClipboard() {
        text = document.querySelector(".torchlight-copy-target").textContent;
        navigator.clipboard.writeText(text);
        // show the "copied" message for 2 seconds
        this.showMessage = true;
        setTimeout(() => (this.showMessage = false), 2000);
    },
}));

Alpine.start();
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
