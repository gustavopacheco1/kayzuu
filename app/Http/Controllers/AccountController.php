<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function general()
    {
        $account = Account::where('id', Auth::id())->first();
        $account->created_at = $account->creation->format('d/m/Y');
        return view('account.general', $account);
    }

    public function characters()
    {
        $characters = Player::where('account_id', Auth::id())->get();

        return view('account.characters', ['characters' => $characters]);
    }
}
