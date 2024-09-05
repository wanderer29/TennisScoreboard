<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Player;

class MatchScoreService
{
    public function scoreCalcLogic(array $match, string $winner): array
    {
        $opponent = $this->getOpponent($winner);

        if ($this->isPlayingTimeBreak($match)) {
            $match = $this->timeBreakScoreLogic($match, $winner, $opponent);
        } else {
            $match = $this->gamesScoreLogic($match, $winner, $opponent);
        }
        if ($this->isSetsCalcLogic($match, $winner, $opponent)) {
            $match = $this->setsScoreLogic($match, $winner, $opponent);
        }

        return $match;
    }

    public function timeBreakScoreLogic(array $match, string $winner, string $opponent): array
    {
        $match[$winner]['points']++;

        if ($match[$winner]['points'] >= 7 && $match[$winner]['points'] - $match[$opponent]['points'] >= 2) {
            $match[$winner]['sets']++;
            $match['player1']['points'] = 0;
            $match['player2']['points'] = 0;
            $match['player1']['games'] = 0;
            $match['player2']['games'] = 0;
        }

        return $match;
    }

    public function gamesScoreLogic(array $match, string $winner, string $opponent): array
    {
        if ($match[$winner]['points'] == 0) {
            $match[$winner]['points'] = 15;
        } elseif ($match[$winner]['points'] == 15) {
            $match[$winner]['points'] = 30;
        } elseif ($match[$winner]['points'] == 30) {
            $match[$winner]['points'] = 40;
        } elseif ($match[$winner]['points'] == 40) {
            if ($match[$opponent]['points'] == 40) {
                if ($match[$winner]['advantage'] == false) {
                    $match[$winner]['advantage'] = true;
                } elseif ($match[$winner]['advantage'] == true) {
                    $match = $this->incrementGames($match, $winner, $opponent);
                }
            } else {
                $match = $this->incrementGames($match, $winner, $opponent);
            }
        }

        return $match;
    }

    private function incrementGames (array $match, string $winner, string $opponent): array
    {
        $match[$winner]['games']++;
        $match[$winner]['points'] = 0;
        $match[$opponent]['points'] = 0;
        $match[$winner]['advantage'] = false;
        $match[$opponent]['advantage'] = false;

        return $match;
    }

    public function setsScoreLogic(array $match, string $winner, string $opponent): array
    {
        $match[$winner]['sets']++;
        $match[$winner]['games'] = 0;
        $match[$opponent]['games'] = 0;

        return $match;
    }

    private function isPlayingTimeBreak(array $match): bool
    {
        if ($match['player1']['games'] == 6 && $match['player2']['games'] == 6) return true;
        return false;
    }

    private function isSetsCalcLogic(array $match, string $winner, string $opponent): bool
    {
        if ($match[$winner]['games'] >= 6 && $match[$winner]['games'] - $match[$opponent]['games'] >= 2) return true;
        return false;
    }

    private function getOpponent($player): string
    {
        return $player == 'player1' ? 'player2' : 'player1';
    }

    public function saveMatchToDatabase(array $match, string $winner): void
    {
        $player1ID = $this->getPlayerID($match['player1']['name']);
        $player2ID = $this->getPlayerID($match['player2']['name']);
        $winnerID = $this->getPlayerID($match[$winner]['name']);

        Game::create([
            'player1' => $player1ID,
            'player2' => $player2ID,
            'winner' => $winnerID,
        ]);
    }

    private function getPlayerID(string $playerName): int
    {
        $player = Player::where('name', $playerName)->first();

        if (!$player) {
            $player = Player::create(['name' => $playerName]);
        }

        return $player->id;
    }

}
