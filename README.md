# Installing concrete5 via composer

```bash
$ composer create-project concrete5/composer:8.x-dev newproject
$ cd newproject

# Use composer to prepare the core
$ composer install

# Use the concrete5 CLI tool to run the c5 install
$ ./vendor/bin/concrete5 c5:install -i
```

## Future Plans
* Separate public directory and vendor directory
* Install concrete5 core without the extra `composer install`
