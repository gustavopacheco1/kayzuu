<?php

namespace App\Services;

use App\Models\Player;

class PlayerService
{
    public function createPlayer(array $data): Player
    {
        return Player::create([
            'account_id' => auth()->user()->id,
            'name' => $data["name"],
            'vocation' => $data["vocation"],
            'sex' => 1,
        ]);
    }
}
