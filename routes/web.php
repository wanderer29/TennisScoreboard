<?php

use App\Http\Controllers\MatchScoreController;
use App\Http\Controllers\NewMatchController;
use App\Http\Controllers\PlayedMatchesContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_page');
})->name('home_page');

Route::get('/new-matches/create', [NewMatchController::class, 'create'])->name('new-matches.create');

Route::post('/new-matches', [NewMatchController::class, 'store'])->name('new-matches.store');

Route::get('/matches-score', [MatchScoreController::class, 'index'])->name('match-scores.index');

Route::get('/matches', [PlayedMatchesContoller::class, 'index'])->name('matches.index');



