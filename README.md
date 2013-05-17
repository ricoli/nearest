#nearest

[![Build Status](https://travis-ci.org/ricoli/nearest.png)](https://travis-ci.org/ricoli/nearest)

Gives the nearest timestamp by X seconds

##Example

    $nearest = new \Ricoli\Nearest\Nearest();
    $nearestTimestamp = $nearest->getNearestTimestamp(300, time());

Will give you the closest 5 minutes from now, defaulting to the PHP_ROUND_HALF_UP rounding mode.
So if the current time is 13:02:30, it would return 13:05 (in its timestamp form).
Supports the same rounding modes as the round function [http://php.net/manual/en/function.round.php](http://php.net/manual/en/function.round.php).
The mode can be provided as the third argument:

    $nearest = new \Ricoli\Nearest\Nearest();
    $nearestTimestamp = $nearest->getNearestTimestamp(300, time(), PHP_ROUND_HALF_DOWN);