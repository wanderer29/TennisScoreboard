<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Services\MatchScoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Transport\ResendTransport;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MatchScoreController extends Controller
{
    public function index()
    {
        $match = Cache::get('current_match');
    }

    public function store(Request $request): View|RedirectResponse
    {
        $match = Cache::get('current_match');

        if (!is_array($match)) {
            $match = json_decode($match, true);
        }

        $winner = $request->input('winner');
        $matchScoreService = new MatchScoreService();

        $match = $matchScoreService->scoreCalcLogic($match, $winner);

        if ($match[$winner]['sets'] >= 2) { //If game over
            $matchScoreService->saveMatchToDatabase($match, $winner);
            Cache::forget('current_match');
            session()->put('match_result', $match);
            session()->put('winner', $winner);
            return redirect()->route('finished-match.result');
        }

        Cache::set('current_match', json_encode($match));

        return view('match_score_page', ['match' => $match]);
    }

    public function showMatchResult(): View
    {
        $match = session()->get('match_result');
        $winner = session()->get('winner');

        return view('finished_match_page', ['match' => $match, 'winner' => $winner]);
    }
}
