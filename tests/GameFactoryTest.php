<?php

namespace BowlingCalc;

class GameFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnCorrectFrames()
    {
        $throws = '--------------------';
        $gameFactory = new GameFactory(new FrameBuilder());
        $game = $gameFactory->create($throws);        
        $expectedGame = new Game([
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
         ]);
        $this->assertEquals($expectedGame, $game);
    }

    public function testItShouldReturnCorrectFramesWithOddLastFrame()
    {
        $throws = '------------------X--';
        $gameFactory = new GameFactory(new FrameBuilder());
        $game = $gameFactory->create($throws);
        $expectedGame = new Game([
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new Frame(0,0),
            new LastFrame(10,0,0),
         ]);
        $this->assertEquals($expectedGame, $game);
    }
}
