# Composer Based Skeleton for Concrete sites

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.txt)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

## Creating a new project

First choose a name for your project. In this example, our project is called "the_oregon_trail"

```bash
$ composer create-project -n concretecms/composer the_oregon_trail
```

Now you have the latest version of Concrete and you're ready to install!

Note: This is a skeleton project. So once you create a project, you can install your own VCS and change the README and all that.

## Starting with the Concrete latest develop

First create a new project
```bash
$ composer create-project -n concretecms/composer the_oregon_trail
```

Then navigate into that project and require the `dev-develop` version of `concretecms/core`
```bash
$ cd the_oregon_trail
$ composer require concretecms/core:dev-develop
```

## Installing Concrete

Navigate into your new Concrete project

```bash
$ cd the_oregon_trail
```

and use the interactive install commmand that comes with Concrete's CLI tool

```bash
$ ./vendor/bin/concrete c5:install -i
```
Follow directions and your site will begin installing!


Note: You can also run the CLI tool directly with PHP

```bash
$ ./public/concrete/bin/concrete
```

## Install a Concrete package using composer

Find the package you'd like to install on [packagist.org](https://packagist.org) (in this case [`concretecms/sample_composer_package`](https://packagist.org/packages/concretecms/sample_composer_package))

Note: You can also use composer's repository functionality to manage private packages using composer

```bash
$ composer require concretecms/sample_composer_package
$ ./vendor/bin/concrete c5:package-install sample_composer_package
```

## Compiling JS / CSS assets
This library uses [Laravel Mix][link-mix]. See [webpack.mix.js][link-webpack-mix-file].
To build assets:

```bash
npm install
npm run dev   # Build for development
npm run hot   # Build with hot reloading enabled (See hot reloading section)
npm run watch # Build with a watcher that rebuilds when files change
npm run prod  # Build for production
```

### Hot Module Replacement
Hot module replacement (hot reloading) allows you to write code and instantly see the changes in your browser, without reloading the page.
In order to use hot reloading with Concrete, you'll want to use the `mix` and `mixAsset` helper functions to wrap your
js and css urls. These functions make it so that your assets automatically detect hot reloading mode and output the
appropriate urls, they are safe to use in production:

In a page theme:
```php
<?php
use function Concrete5\Composer\mixAsset;
...

class PageTheme extends Theme
{
  public function registerAssets()
  {
    $this->requireAsset(mixAsset('/path/to/file.js'));
  }
}
```

```php
<?php
use function Concrete5\Composer\mixAsset;
...

class Controller extends BlockController
{
    public function registerViewAssets()
    {
        $this->requireAsset(mixAsset('/path/to/js/file.js'));
        $this->requireAsset(mixAsset('/path/to/css/file.css'));
    }
}
```
or in a theme template:
```php
<?php
use function Concrete5\Composer\mix;
?>

<script src='<?= mix('/path/to/your/asset.js') ?>'></script>
<link href='<?= mix('/path/to/your/asset.css') ?>' />
```

## Free marketplace addons

Do you want to install an add-on that is free in the Concrete marketplace, but not on packagist.org? Go to https://composer.concretecms.org/.

[ico-version]: https://img.shields.io/packagist/v/concretecms/composer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/concretecms/composer/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/concretecms/composer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/concretecms/composer
[link-travis]: https://travis-ci.org/concretecms/composer
[link-downloads]: https://packagist.org/packages/concretecms/composer
[link-mix]: https://laravel.com/docs/5.5/mix
[link-webpack-mix-file]: ./webpack.mix.js

