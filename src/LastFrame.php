<?php

namespace BowlingCalc;

class LastFrame implements FrameInterface
{
    protected $firstThrow;
    protected $secondThrow;
    protected $thirdThrow;

    /**
     * Frame constructor.
     * @param $firstThrow
     * @param $secondThrow
     */
    public function __construct($firstThrow, $secondThrow, $thirdThrow)
    {
        $this->firstThrow = $firstThrow;
        $this->secondThrow = $secondThrow;
        $this->thirdThrow = $thirdThrow;
    }

    /**
     * @return FrameInterface
     */
    public function getNextFrame()
    {
        return null;
    }

    public function getFirstThrowPins()
    {
        return $this->firstThrow;
    }

    public function getSecondThrowPins()
    {
        return $this->secondThrow;
    }

    public function getFrameScore()
    {
        return $this->firstThrow + $this->secondThrow + $this->thirdThrow;
    }
}