<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class PlayerRepository
{
    public function getHighscorePlayers(): Collection
    {
        $players = Player::orderByDesc('level')->take(50)->get();

        return $players;
    }

    public function getPlayersOnline(): Collection
    {
        $players = Player::join('players_online', 'players.id', '=', 'players_online.player_id')
            ->select('id', 'name', 'vocation', 'level')
            ->orderByDesc('level')
            ->get();

        return $players;
    }
}
