<?php

namespace BowlingCalc;

class Frame implements FrameInterface
{
    protected $firstThrow;
    protected $secondThrow;
    /**
     * @var FrameInterface
     */
    protected $nextFrame = null;

    /**
     * Frame constructor.
     * @param $firstThrow
     * @param $secondThrow
     */
    public function __construct($firstThrow, $secondThrow)
    {
        $this->firstThrow = $firstThrow;
        $this->secondThrow = $secondThrow;
    }

    /**
     * @return FrameInterface
     */
    public function getNextFrame()
    {
        return $this->nextFrame;
    }

    /**
     * @param FrameInterface $nextFrame
     */
    public function setNextFrame($nextFrame)
    {
        $this->nextFrame = $nextFrame;
    }

    public function getFirstThrowPins()
    {
        return $this->firstThrow;
    }

    public function getSecondThrowPins()
    {
        if($this->firstThrow !== 10){
            return $this->secondThrow;
        } elseif ($this->nextFrame !== null) {
            return $this->nextFrame->getFirstThrowPins();
        }
        return 0;
    }

    private function getFirstThrowScore()
    {
        $score = $this->firstThrow;
        if($this->firstThrow === 10 && $this->nextFrame){
            $score += $this->nextFrame->getFirstThrowPins();
            $score += $this->nextFrame->getSecondThrowPins();
        }
        return $score;
    }
    
    private function getSecondThrowScore()
    {
        if($this->firstThrow === 10)
            return 0;
        $score = $this->secondThrow;
        if(($this->firstThrow + $this->secondThrow) === 10 && $this->nextFrame){
            $score += $this->nextFrame->getFirstThrowPins();
        }
        return $score;
    }
    
    public function getFrameScore()
    {
        return $this->getFirstThrowScore() + $this->getSecondThrowScore();
    }

}