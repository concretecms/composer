# Composer Based Skeleton for concrete5 sites

## Creating a new project

First choose a name for your project. In this example, our project is called "the_oregon_trail"

```bash
$ composer create-project -n concrete5/composer:8.x-dev the_oregon_trail
```

Now you have the latest version of concrete5 and you're ready to install!

Note: This is a skeleton project. So once you create a project, you can install your own VCS and change the README and all that.


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
$ php public/concrete/bin/concrete5.php
```

## Install a concrete5 package using composer

Find the package you'd like to install on [packagist.org](https://packagist.org) (in this case [`concrete5/sample_composer_package`](https://packagist.org/packages/concrete5/sample_composer_package))

Note: You can also use composer's repository functionality to manage private packages using composer

```bash
$ composer require concrete5/sample_composer_package
$ ./vendor/bin/concrete5 c5:package-install sample_composer_package
```
