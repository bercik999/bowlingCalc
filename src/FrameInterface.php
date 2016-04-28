<?php

namespace BowlingCalc;

interface FrameInterface
{
    /**
     * @return FrameInterface
     */
    public function getNextFrame();
    
    public function getFirstThrowPins();
    public function getSecondThrowPins();
    public function getFrameScore();
    
}