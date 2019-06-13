# environment

[![Travis CI](https://api.travis-ci.org/qlimix/environment.svg?branch=master)](https://travis-ci.org/qlimix/environment)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/environment.svg)](https://coveralls.io/qlimix/environment)
[![Coveralls](https://img.shields.io/packagist/v/qlimix/environment.svg)](https://packagist.org/packages/qlimix/environment)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/environment/blob/master/LICENSE)

Environment utilities. Loading env values through type loader.

## Install

Using Composer:

`composer require qlimix/environment`

## usage

### Environment object
Create at bootstrapping based on for example an env value
```
<?php

use Qlimix\Environment\Environment;

$env = Environment::createDevelopment();
```

### Environment object
Create at bootstrapping based on for example an env value
```
<?php

use Qlimix\Environment\Value\Loader;

$env = new Loader();
$env->load
$string = $env->getString('value');
$integer = $env->getInt('value');
$float = $env->getFloat('value');
$bool = $env->getBoolean('value');
$array = $env->getArray('value', ',');
$mapped = $env->getMapped('value', function (string $value) {
    return base64_decode($value);
});
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
