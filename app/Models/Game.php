<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    protected $guarded = [];

    public function getPlayer1Name(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player1');
    }

    public function getPlayer2Name(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player2');
    }

    public function getWinnerName(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'winner');
    }
}
