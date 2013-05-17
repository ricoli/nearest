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

        if (!in_array($mode, array(PHP_ROUND_HALF_UP, PHP_ROUND_HALF_DOWN, PHP_ROUND_HALF_EVEN, PHP_ROUND_HALF_ODD))) {
            throw new \InvalidArgumentException(sprintf('Invalid mode provided: "%s". It must be a mode supported by the round function.', $mode));
        }
        return (int) round($timestamp/$seconds, 0, $mode)*$seconds;
    }
}
