<?php

namespace BowlingCalc;

class FrameBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testFrameBufferShouldReturnCorrectFrame()
    {
        $frameBuffer = new FrameBuilder();
        $frameBuffer->addThrow(1);
        $frameBuffer->addThrow(1);
        $actualFrames = $frameBuffer->getFrames();
        $expectedFrames = [
            new Frame(1,1)
        ];
        $this->assertEquals($expectedFrames, $actualFrames);
    }

    public function testFrameBufferShouldReturnCorrectFrameWithMiss()
    {
        $frameBuffer = new FrameBuilder();
        $frameBuffer->addThrow(1);
        $frameBuffer->addThrow('-');
        $actualFrames = $frameBuffer->getFrames();
        $expectedFrames = [
            new Frame(1,0)
        ];
        $this->assertEquals($expectedFrames, $actualFrames);
    }

    public function testFrameBufferShouldReturnCorrectFrameWithSpare()
    {
        $frameBuffer = new FrameBuilder();
        $frameBuffer->addThrow(1);
        $frameBuffer->addThrow('/');
        $actualFrames = $frameBuffer->getFrames();
        $expectedFrames = [
            new Frame(1,9)
        ];
        $this->assertEquals($expectedFrames, $actualFrames);
    }

    public function testFrameBufferShouldReturnCorrectFrameWithStrike()
    {
        $frameBuffer = new FrameBuilder();
        $frameBuffer->addThrow('X');
        $frameBuffer->addThrow(1);
        $frameBuffer->addThrow('/');
        $actualFrames = $frameBuffer->getFrames();
        $expectedFrames = [
            new Frame(10,null),
            new Frame(1,9),
        ];
        $this->assertEquals($expectedFrames, $actualFrames);
    }

    /**
     * @dataProvider lastThrowsProvider
     */
    public function testFrameBufferShouldReturnCorrectLastFrame($throws, $expectedFrame)
    {
        $frameBuffer = new FrameBuilder();
        foreach ($throws as $throw) {
            $frameBuffer->addLastFrameThrow($throw);
        }
        $actualFrames = $frameBuffer->getFrames();
        $expectedFrames = [
            $expectedFrame
        ];
        $this->assertEquals($expectedFrames, $actualFrames);
    }

    public function lastThrowsProvider(){
        return[
            [['X',1,'/'], new LastFrame(10,1,9)],
            [['X','X','X'], new LastFrame(10,10,10)],
            [['X','1','-'], new LastFrame(10,1,0)],
        ];
    }

}
