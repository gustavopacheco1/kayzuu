<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function general(): View
    {
        $account = Account::where('id', Auth::id())->first();
        $account->created_at = $account->creation->format('d/m/Y');

        return view('account.general', $account);
    }

    public function characters(): View
    {
        $characters = Player::where('account_id', Auth::id())->get();

        return view('account.characters', ['characters' => $characters]);
    }
}
