<?php

namespace App\Http\Controllers;

use App\Models\Player;

class CommunityController extends Controller
{
    public function highscore()
    {
        $players = Player::orderByDesc('level')->take(50)->get();

        return view('community.highscore', ['players' => $players]);
    }

    public function online()
    {
        $players = Player::join('players_online', 'players.id', '=', 'players_online.player_id')
            ->select('id', 'name', 'vocation', 'level')
            ->orderByDesc('level')
            ->get();

        return view('community.online', ['players' => $players]);
    }
}
