<?php

namespace BowlingCalc;

interface FrameInterface
{
    public function firstThrowPins();
    public function secondThrowPins();
    public function calculateFrameScore();
}