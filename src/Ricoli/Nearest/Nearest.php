<?php

namespace Ricoli\Nearest;

class Nearest
{
    const NEAREST_CEIL = 3;
    const NEAREST_FLOOR = 4;

    /**
     * @param integer $seconds
     * @param integer $timestamp
     * @param integer $mode
     *
     * @return integer
     * @throws \InvalidArgumentException
     */
    public function getNearestTimestamp($seconds, $timestamp, $mode = PHP_ROUND_HALF_UP)
    {
        if (!is_int($seconds) || $seconds < 1) {
            throw new \InvalidArgumentException(sprintf('Invalid number of seconds provided: "%s". It must be a greater than 0 integer.', $seconds));
        }

        if (!is_int($timestamp) || $timestamp < 1) {
            throw new \InvalidArgumentException(sprintf('Invalid timestamp provided: "%s". It must be a greater than 0 integer.', $timestamp));
        }

        if (!in_array($mode, array(PHP_ROUND_HALF_UP, PHP_ROUND_HALF_DOWN, static::NEAREST_CEIL, static::NEAREST_FLOOR))) {
            throw new \InvalidArgumentException(sprintf('Invalid mode provided: "%s". It must be one of PHP_ROUND_HALF_UP, PHP_ROUND_HALF_DOWN, NEAREST_CEIL, NEAREST_FLOOR.', $mode));
        }

        $numberOfIntervals = $timestamp/$seconds;
        $nearestInterval = null;

        switch ($mode) {
            case static::NEAREST_CEIL:
                $nearestInterval = ceil($numberOfIntervals);
                break;
            case static::NEAREST_FLOOR:
                $nearestInterval = floor($numberOfIntervals);
                break;
            default:
                $nearestInterval = round($numberOfIntervals, 0, $mode);
        }

        return (int) $nearestInterval * $seconds;
    }
}
