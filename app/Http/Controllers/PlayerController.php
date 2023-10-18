<?php

namespace App\Http\Controllers;

use App\Http\Requests\Player\StoreRequest;
use App\Models\Player;
use App\Repositories\PlayerRepository;
use App\Services\PlayerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct(private PlayerRepository $playerRepository, private PlayerService $playerService)
    {
    }

    public function show(Player $player): View
    {
        return view('player.show', compact('player'));
    }

    public function create(): View
    {
        $vocations = config('tibia.vocations');

        return view('player.create', compact('vocations'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->playerService->createPlayer($request->validated);

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
                'message' => "There is no player with name {$request->input('name')}.",
            ])->onlyInput('name');
        }

        return redirect()->route('player.show', [$player->id]);
    }

    public function highscore(int $skillType = 0)
    {
        $players = $this->playerRepository->getHighscorePlayers($skillType);

        return view('player.highscore', compact('players', 'skillType'));
    }

    public function online(): View
    {
        $players = $this->playerRepository->getPlayersOnline();

        return view('player.online', compact('players'));
    }
}
