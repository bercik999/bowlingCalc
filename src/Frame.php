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
     * @param FrameInterface $nextFrame
     */
    public function bindNextFrame($nextFrame)
    {
        $this->nextFrame = $nextFrame;
    }

    public function firstThrowPins()
    {
        return $this->firstThrow;
    }

    public function secondThrowPins()
    {
        if($this->firstThrow !== 10){
            return $this->secondThrow;
        } elseif ($this->nextFrame !== null) {
            return $this->nextFrame->firstThrowPins();
        }
        return 0;
    }

    private function calculateFirstThrowScore()
    {
        $score = $this->firstThrow;
        if($this->firstThrow === 10 && $this->nextFrame){
            $score += $this->nextFrame->firstThrowPins();
            $score += $this->nextFrame->secondThrowPins();
        }
        return $score;
    }
    
    private function calculateSecondThrowScore()
    {
        if($this->firstThrow === 10)
            return 0;
        $score = $this->secondThrow;
        if(($this->firstThrow + $this->secondThrow) === 10 && $this->nextFrame){
            $score += $this->nextFrame->firstThrowPins();
        }
        return $score;
    }
    
    public function calculateFrameScore()
    {
        return $this->calculateFirstThrowScore() + $this->calculateSecondThrowScore();
    }

}