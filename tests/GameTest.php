<?php

namespace BowlingCalc;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $input
     * @param $score
     * @dataProvider gamesProvider
     */
    public function testGetScore($input, $score){
        $gameFactory = new GameFactory(new FrameBuilder());
        $game = $gameFactory->create($input);
        $this->assertEquals($score, $game->calculateScore());
    }

    public function gamesProvider()
    {
        $games = [
            ["--------------------",0],
            ["1-------------------",1],
            ["1/------------------",10],
            ["1/2-----------------",14],
            ["1/-2----------------",12],
            ["X2-----------------",14],
            ["X-2----------------",14],
            ["X--2---------------",12],
            ["X22----------------",18],
            ["--X22--------------",18],
            ["-1X22--------------",19],
            ["------------------X--",10],
            ["------------------1/1",11],
            ["----------------X1/1",31],
            ["----------------1/1/1",22],
            ["12345123451234512345",60],
            ["XXXXXXXXXXXX",300],
            ["9-9-9-9-9-9-9-9-9-9-",90],
            ["5/5/5/5/5/5/5/5/5/5/5",150],
        ];
        return $games;
    }
}
