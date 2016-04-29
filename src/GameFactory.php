<?php

namespace BowlingCalc;

class GameFactory {
    /**
     * @var FrameBuilder
     */
    protected $frameBuilder;

    /**
     * GameFactory constructor.
     * @param $frameBuffer
     */
    public function __construct($frameBuffer)
    {
        $this->frameBuilder = $frameBuffer;
    }

    /**
     * @param $stringToParse
     * @return Game
     */
    public function create($stringToParse)
    {
        $throws = str_split($stringToParse);
        $simpleThrows = $this->prepareSimpleThrows($throws);

        $this->frameBuilder = new FrameBuilder();
        $this->addSimpleThrowsToBuffer($simpleThrows);
        $this->addLastFrameThrowsToBuffer($throws);
        $frames = $this->bindFrames();

        return new Game($frames);
    }

    private function isLastFrameSpecial($throws)
    {
        return $throws[count($throws) - 3] === 'X' || $throws[count($throws) - 2] === '/';
    }

    /**
     * @return FrameInterface[]
     */
    private function bindFrames()
    {
        $frames = $this->frameBuilder->getFrames();
        foreach ($frames as $i => &$frame) {
            if (!isset($frames[$i + 1]))
                break;
            $frame->bindNextFrame($frames[$i + 1]);
        }
        return $frames;
    }

    /**
     * @param $throws
     * @return mixed
     */
    private function prepareSimpleThrows($throws)
    {
        if (!$this->isLastFrameSpecial($throws)) {
            $simpleThrows = $throws;
            return $simpleThrows;
        } else {
            $simpleThrows = array_slice($throws, 0, count($throws) - 3);
            return $simpleThrows;
        }
    }

    /**
     * @param $simpleThrows
     * @return mixed
     */
    private function addSimpleThrowsToBuffer($simpleThrows)
    {
        foreach ($simpleThrows as $throw) {
            $this->frameBuilder->addThrow($throw);
        }
    }

    /**
     * @param $throws
     */
    private function addLastFrameThrowsToBuffer($throws)
    {
        if ($this->isLastFrameSpecial($throws)) {
            $lastFrameThrows = array_slice($throws, count($throws) - 3, 3);
            foreach ($lastFrameThrows as $throw) {
                $this->frameBuilder->addLastFrameThrow($throw);
            }
        }
    }
}