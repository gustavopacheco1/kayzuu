<?php

namespace App\Http\Controllers;

use App\Http\Requests\Player\StoreRequest;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show(Player $player): View
    {
        return view('player.show', ['player' => $player]);
    }

    public function create(): View
    {
        $vocations = config('tibia.vocations');

        return view('player.create', ['vocations' => $vocations]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Player::create([
            'account_id' => $request->user()->id,
            'name' => $request->name,
            'vocation' => $request->vocation,
            'sex' => 1,
        ]);

        return redirect()->route('account.characters');
    }

    public function search(): View
    {
        return view('player.search');
    }

    public function find(Request $request): RedirectResponse
    {
        $player = Player::where('name', $request->input('name'))->first();

        if (!$player) {
            return back()->withErrors([
                'message' => "There's no player with name {$request->input('name')}.",
            ])->onlyInput('name');
        }

        return redirect()->route('player.show', [$player->id]);
    }
}
