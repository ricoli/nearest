<?php

namespace Ricoli\Nearest\Tests;

use Ricoli\Nearest\Nearest;

class NearestTest extends \PHPUnit_Framework_TestCase
{
    private $nearest;

    public function setUp()
    {
        $this->nearest = new Nearest();
    }

    /**
     * @dataProvider getInvalidSecondsTestCases
     * @expectedException InvalidArgumentException
     */
    public function test_getNearestTimestamp_throws_InvalidArgumentException_if_seconds_is_not_positive_integer($seconds)
    {
        $this->nearest->getNearestTimestamp($seconds, 111);
    }

    public function getInvalidSecondsTestCases()
    {
        return array(
            array('string'),
            array(0),
            array(1.1)
        );
    }

    /**
     * @dataProvider getInvalidTimestampTestCases
     * @expectedException InvalidArgumentException
     */
    public function test_getNearestTimestamp_throws_InvalidArgumentException_if_timestamp_is_not_positive_integer($timestamp)
    {
        $this->nearest->getNearestTimestamp(300, $timestamp);
    }

    public function getInvalidTimestampTestCases()
    {
        return array(
            array('string'),
            array(0),
            array(1.1)
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_getNearestTimestamp_throws_InvalidArgumentException_if_invalid_mode_is_passed()
    {
        $this->nearest->getNearestTimestamp(1, 1, 'this is sparta!');
    }

    public function test_getNearestTimestamp_returns_nearest_timestamp_according_to_number_of_seconds()
    {
        $this->assertSame(915195600, $this->nearest->getNearestTimestamp(3600, 915195750));
        $this->assertSame(915235200, $this->nearest->getNearestTimestamp(86400, 915195750));
    }

    public function test_getNearestTimestamp_returns_nearest_timestamp_using_default_mode()
    {
        $this->assertSame(1368801000, $this->nearest->getNearestTimestamp(300, 1368801112));
    }

    /**
     * @dataProvider getModesTestCases
     */
    public function test_getNearestTimestamp_returns_nearest_timestamp_according_to_mode($timestamp, $mode, $expectedTimestamp)
    {
        $this->assertSame(strtotime($expectedTimestamp), $this->nearest->getNearestTimestamp(300, strtotime($timestamp), $mode));
    }

    public function getModesTestCases()
    {
        return array(
            array('1 January 1970 13:02:30', PHP_ROUND_HALF_DOWN, '1 January 1970 13:00:00'),
            array('1 January 1970 13:02:30', PHP_ROUND_HALF_UP, '1 January 1970 13:05:00'),
            array('1 January 1970 13:05:01', Nearest::NEAREST_CEIL, '1 January 1970 13:10:00'),
            array('1 January 1970 13:10:00', Nearest::NEAREST_CEIL, '1 January 1970 13:10:00'),
            array('1 January 1970 13:09:59', Nearest::NEAREST_FLOOR, '1 January 1970 13:05:00'),
            array('1 January 1970 13:15:00', Nearest::NEAREST_FLOOR, '1 January 1970 13:15:00')
        );
    }
}
