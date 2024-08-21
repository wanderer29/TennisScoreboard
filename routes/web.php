<?php

use App\Http\Controllers\MatchScoreController;
use App\Http\Controllers\NewMatchController;
use App\Http\Controllers\PlayedMatchesContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_page');
});

Route::get('/new-match', [NewMatchController::class, 'index']);

Route::get('/match-score', [MatchScoreController::class, 'index']);

Route::get('/matches', [PlayedMatchesContoller::class, 'index']);
