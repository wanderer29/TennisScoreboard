<?php

namespace App\Http\Controllers;


use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Nette\Utils\Html;

class NewMatchController extends Controller
{
    public function index(): View
    {
        return view('new_match_page');
    }

    public function create(Request $request): View
    {
        $name1 = $request->input('name1');
        $name2 = $request->input('name2');

        $result = ($name1 === $name2) ? 'Names the same' : 'Names are different';

        return view('match_score_page', ['result' => $result]);
    }

    public function isPlayerExsits(Player $player): bool
    {
        $players = Player::all();
        if ($players->contains($player)) {
            return true;
        }
        return false;
    }


    public function createGame(int $player1ID, int $player2ID, int $winnerID): null
    {
        Game::create([
            'player1' => $player1ID,
            'player2' => $player2ID,
            'winner' => $winnerID,
        ]);
        dd('created');
    }

    public function createPlayer(string $name): void
    {
        Player::create(['name' => $name]);
    }
}
