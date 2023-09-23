<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function highscore()
    {
        $players = Player::orderByDesc('level')->take(50)->get();

        return view('community.highscore', ['players' => $players]);
    }
}
