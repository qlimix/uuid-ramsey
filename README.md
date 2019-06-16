# uuid-ramsey

[![Travis CI](https://api.travis-ci.org/qlimix/uuid-ramsey.svg?branch=master)](https://travis-ci.org/qlimix/uuid-ramsey)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/uuid-ramsey.svg)](https://coveralls.io/qlimix/uuid-ramsey)
[![Packagist](https://img.shields.io/packagist/v/qlimix/uuid-ramsey.svg)](https://packagist.org/packages/qlimix/uuid-ramsey)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/uuid-ramsey/blob/master/LICENSE)


description.

## Install

Using Composer:

~~~
$ composer require qlimix/uuid-ramsey
~~~

## usage
```php
<?php

use \Qlimix\Id\Uuid\Generator\RamseyUuidGenerator;
use Throwable;

$generator = new RamseyUuidGenerator();
try {
    $uuid = $generator->generate();
} catch (Throwable $exception) {
    // UuidGeneratorException
}

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
