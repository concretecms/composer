# Composer Based Skeleton for concrete5 sites

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.txt)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

## Creating a new project

First choose a name for your project. In this example, our project is called "the_oregon_trail"

```bash
$ composer create-project -n concrete5/composer the_oregon_trail
```

Now you have the latest version of concrete5 and you're ready to install!

Note: This is a skeleton project. So once you create a project, you can install your own VCS and change the README and all that.

## Starting with the concrete5 latest develop

```bash
$ composer create-project -n concrete5/composer:8.x-dev the_oregon_trail
```

## Installing concrete5

Navigate into your new concrete5 project

```bash
$ cd the_oregon_trail
```

and use the interactive install commmand that comes with concrete5's CLI tool

```bash
$ ./vendor/bin/concrete5 c5:install -i
```
Follow directions and your site will begin installing!


Note: You can also run the CLI tool directly with PHP

```bash
$ ./public/concrete/bin/concrete5
```

## Install a concrete5 package using composer

Find the package you'd like to install on [packagist.org](https://packagist.org) (in this case [`concrete5/sample_composer_package`](https://packagist.org/packages/concrete5/sample_composer_package))

Note: You can also use composer's repository functionality to manage private packages using composer

```bash
$ composer require concrete5/sample_composer_package
$ ./vendor/bin/concrete5 c5:package-install sample_composer_package
```

## Compiling JS / CSS assets
This library uses [Laravel Mix][link-mix]. See [webpack.mix.js][link-webpack-mix-file].
Using Yarn run (If you're using NPM instead, just swap `yarn` for `npm`.):

```
yarn install
yarn run dev
```

To compile assets for development.

Do you want to install an add-on that is free in the concrete5 marketplace, but not on packagist.org? Go to https://composer.concrete5.org.

[ico-version]: https://img.shields.io/packagist/v/concrete5/composer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/concrete5/composer/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/concrete5/composer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/concrete5/composer
[link-travis]: https://travis-ci.org/concrete5/composer
[link-downloads]: https://packagist.org/packages/concrete5/composer
[link-mix]: https://laravel.com/docs/5.5/mix
[link-webpack-mix-file]: ./webpack.mix.js
