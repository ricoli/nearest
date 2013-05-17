<?php

namespace Ricoli\Nearest;

class Nearest
{
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

        return (int) round($timestamp/$seconds, 0, $mode)*$seconds;
    }
}
