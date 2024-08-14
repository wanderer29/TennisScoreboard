<?php

use App\Http\Controllers\MatchScoreController;
use App\Http\Controllers\NewMatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new-match', [NewMatchController::class, 'create']);

Route::get('/match-score', [MatchScoreController::class, 'index']);

Route::get('/matches', function () {
    return "matches";
});


