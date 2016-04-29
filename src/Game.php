<?php

namespace BowlingCalc;

class Game {
    /**
     * @var FrameInterface[]
     */
    protected $frames;

    /**
     * Game constructor.
     * @param FrameInterface[] $frames
     */
    public function __construct(array $frames)
    {
        $this->frames = $frames;
    }

    public function calculateScore()
    {
        $sum = 0;
        foreach ($this->frames as $frame) {
            $sum += $frame->calculateFrameScore();
        }
        return $sum;
    }
}
