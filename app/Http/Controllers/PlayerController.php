<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Closure;
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
            'name' => [
                'required',
                'unique:players',
                'string',
                'max:32',
            ],
            'vocation' => [
                'required',
                'int',
                'max:255',
                function (string $attribute, mixed $value, Closure $fail) {
                    $vocation = config('tibia.vocations')[$value];
                    if (!isset($vocation) || !$vocation['createable']) {
                        $fail("The {$attribute} is invalid.");
                    }
                }
            ],
        ]);
    }

    public function show(int $id)
    {
        $player = Player::where('id', $id)->first();

        return view('player.show', ['player' => $player]);
    }

    public function create()
    {
        $vocations = config('tibia.vocations');

        return view('player.create', ['vocations' => $vocations]);
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
