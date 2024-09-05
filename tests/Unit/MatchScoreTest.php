<?php

namespace Tests\Unit;

use App\Services\MatchScoreService;
use PHPUnit\Framework\TestCase;

class MatchScoreTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testPlayerWinsPointAtDeuce()
    {
        $match = [
            'player1' => ['points' => 40, 'games' => 0, 'sets' => 0, 'advantage' => false],
            'player2' => ['points' => 40, 'games' => 0, 'sets' => 0, 'advantage' => false],
        ];

        $service = new MatchScoreService();
        $match = $service->gamesScoreLogic($match, 'player1', 'player2');

        $this->assertTrue($match['player1']['advantage']);
        $this->assertFalse($match['player2']['advantage']);
    }


    public function testPlayerWinsPointAndWinGame()
    {
        //When one player have 40 points, and other one don't. Player 1 win game

        $match = [
            'player1' => ['points' => 40, 'games' => 0, 'sets' => 0, 'advantage' => false],
            'player2' => ['points' => 0, 'games' => 0, 'sets' => 0, 'advantage' => false],
        ];

        $service = new MatchScoreService();
        $match = $service->gamesScoreLogic($match, 'player1', 'player2');

        $this->assertEquals(0, $match['player1']['points']);
        $this->assertEquals(0, $match['player2']['points']);
        $this->assertEquals(1, $match['player1']['games']);
    }

    public function testTimeBreakStart()
    {
        //Time-break starts when players have 6-6 at games

        $match = [
            'player1' => ['points' => 0, 'games' => 6, 'sets' => 0, 'advantage' => false],
            'player2' => ['points' => 0, 'games' => 6, 'sets' => 0, 'advantage' => false],
        ];

        $service = new MatchScoreService();
        $match = $service->scoreCalcLogic($match, 'player1');

        $this->assertEquals(1, $match['player1']['points']);
    }

    public function testSetCount()
    {
        //When one player have 6 games and opponent have 4 or less, player 1 win set

        $match = [
            'player1' => ['points' => 40, 'games' => 6, 'sets' => 0, 'advantage' => false],
            'player2' => ['points' => 0, 'games' => 4, 'sets' => 0, 'advantage' => false],
        ];

        $service = new MatchScoreService();
        $match = $service->scoreCalcLogic($match, 'player1');

        $this->assertEquals(1, $match['player1']['sets']);
        $this->assertEquals(0, $match['player2']['sets']);
        $this->assertEquals(0, $match['player1']['points']);
        $this->assertEquals(0, $match['player1']['games']);
        $this->assertEquals(0, $match['player2']['points']);
        $this->assertEquals(0, $match['player2']['games']);
    }

    public function testSetCountThenDifferenceInPointsLessTwo()
    {
        //When one player have ant least 6 games and difference in points with opponent less two
        //games, player 1 won't win set

        $match = [
            'player1' => ['points' => 40, 'games' => 7, 'sets' => 0, 'advantage' => false],
            'player2' => ['points' => 0, 'games' => 7, 'sets' => 0, 'advantage' => false],
        ];

        $service = new MatchScoreService();
        $match = $service->scoreCalcLogic($match, 'player1');

        $this->assertEquals(0, $match['player1']['sets']);
        $this->assertEquals(0, $match['player2']['sets']);
        $this->assertEquals(0, $match['player1']['points']);
        $this->assertEquals(8, $match['player1']['games']);
        $this->assertEquals(0, $match['player2']['points']);
        $this->assertEquals(7, $match['player2']['games']);
    }

}
