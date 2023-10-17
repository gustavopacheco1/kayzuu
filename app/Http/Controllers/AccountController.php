<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AccountController extends Controller
{
    public function general(): View
    {
        $account = auth()->user();

        return view('account.general', compact('account'));
    }

    public function characters(): View
    {
        $characters = auth()->user()->characters;

        return view('account.characters', compact('characters'));
    }
}
