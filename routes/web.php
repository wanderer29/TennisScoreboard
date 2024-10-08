<?php

use App\Http\Controllers\MatchScoreController;
use App\Http\Controllers\NewMatchController;
use App\Http\Controllers\PlayedMatchesContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_page');
})->name('home_page');

Route::get('/new-match/create', [NewMatchController::class, 'create'])->name('new-match.create');

Route::post('/new-match', [NewMatchController::class, 'store'])->name('new-match.store');

Route::get('/match-score', [MatchScoreController::class, 'index'])->name('match-score.index');
Route::post('/match-score', [MatchScoreController::class, 'store'])->name('match-score.store');

Route::get('/matches', [PlayedMatchesContoller::class, 'index'])->name('matches.index');
Route::get('/matches/search', [PlayedMatchesContoller::class, 'search'])->name('matches.search');

Route::get('/match-result', [MatchScoreController::class, 'showMatchResult'])->name('finished-match.result');
