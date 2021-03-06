#nearest

[![Build Status](https://travis-ci.org/ricoli/nearest.png)](https://travis-ci.org/ricoli/nearest) [![Total Downloads](https://poser.pugx.org/ricoli/nearest/downloads.png)](https://packagist.org/packages/ricoli/nearest)

Gives the nearest timestamp by X seconds.
Inspired by the ruby project with the same name.

##Example

    $nearest = new \Ricoli\Nearest\Nearest();
    $nearestTimestamp = $nearest->getNearestTimestamp(300, time());

Will give you the closest 5 minutes from now, defaulting to the PHP_ROUND_HALF_UP rounding mode.
So if the current time is 13:02:30, it would return 13:05:00 (in its timestamp form).
Supports the following modes: PHP_ROUND_HALF_UP, PHP_ROUND_HALF_DOWN, Nearest::NEAREST_CEIL, Nearest::NEAREST_FLOOR.
The mode can be provided as the third argument:

    $nearest = new \Ricoli\Nearest\Nearest();
    $nearestTimestamp = $nearest->getNearestTimestamp(300, time(), PHP_ROUND_HALF_DOWN);

##Add it your your application!

Add to your composer.json:

    "require": {
        ...
        "ricoli/nearest": "dev-master"
    }

https://packagist.org/packages/ricoli/nearest
