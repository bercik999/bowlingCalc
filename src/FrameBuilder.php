<?php

namespace BowlingCalc;

class FrameBuilder
{
    protected $frames = [];
    protected $throwsBuffer = [];

    public function addThrow($throw)
    {
        if($throw === 'X'){
            $this->frames[] =  new Frame(10, 0);
        } elseif(!$this->throwsBuffer){
            $this->throwsBuffer[] = $this->calculatePinsKnocked($throw);
        } else {
            $this->frames[] =  new Frame($this->throwsBuffer[0], $this->calculatePinsKnocked($throw));
            $this->throwsBuffer = [];
        }
    }

    public function addLastFrameThrow($throw)
    {
        if(count($this->throwsBuffer) === 2){
            $this->frames[] = new LastFrame(
                $this->throwsBuffer[0],
                $this->throwsBuffer[1],
                $this->calculatePinsKnocked($throw)
            );
        } else {
            $this->throwsBuffer[] = $this->calculatePinsKnocked($throw);
        }
    }
 
    /**
     * @return Frame[]
     */
    public function getFrames()
    {
        return $this->frames;
    }

    private function calculatePinsKnocked($throw)
    {
        switch ($throw){
            case 'X':
                return 10;
                break;
            case '-':
                return 0;
                break;
            case '/':
                return 10 - end($this->throwsBuffer);
                break;
            default:
                return $throw;
        }
    }
}