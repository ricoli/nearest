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

    public function test_getNearestTimestamp_returns_nearest_timestamp_using_default_mode()
    {
        $this->assertSame(1368801000, $this->nearest->getNearestTimestamp(300, 1368801112));
    }
}
