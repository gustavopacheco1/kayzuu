<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    protected $redirectTo = '/account/characters';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:32'],
            'vocation' => ['required', 'int', 'max:255'],
        ]);
    }

    public function index(int $id)
    {
        $player = Player::where('id', $id)->first();

        return view('player.index', $player);
    }

    public function create()
    {
        return view('player.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        Player::create([
            'account_id' => Auth::id(),
            'name' => $request->name,
            'vocation' => $request->vocation,
            'sex' => 1,
        ]);

        return redirect($this->redirectTo);
    }

    public function search()
    {
        return view('player.search');
    }

    public function find(Request $request): RedirectResponse
    {
        $player = Player::where('name', $request['name'])->first();

        if (!$player) {
            return back()->withErrors([
                'name' => "There's no player with name {$request['name']}.",
            ])->onlyInput('name');
        }

        return redirect("player/{$player->id}");
    }
}
