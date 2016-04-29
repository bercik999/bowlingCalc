<?php

namespace BowlingCalc;

class LastFrameTest extends \PHPUnit_Framework_TestCase
{
    public function testLastFrameWithSpare()
    {
        $frame = new LastFrame(2, 8, 2);
        $this->assertEquals(12, $frame->calculateFrameScore());
    }

    public function testLastFrameWithStrike()
    {
        $frame = new LastFrame(10, 8, 2);
        $this->assertEquals(20, $frame->calculateFrameScore());
    }
}
