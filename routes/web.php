<?php

use App\Http\Controllers\MatchScoreController;
use App\Http\Controllers\NewMatchController;
use App\Http\Controllers\PlayedMatchesContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_page');
})->name('home_page');

Route::get('/new-match', [NewMatchController::class, 'index'])->name('new-match.index');
Route::get('/match-score', [MatchScoreController::class, 'index'])->name('match-score.index');
Route::get('/matches', [PlayedMatchesContoller::class, 'index'])->name('matches.index');

Route::post('/new-match', [NewMatchController::class, 'start'])->name('new-match.create');
