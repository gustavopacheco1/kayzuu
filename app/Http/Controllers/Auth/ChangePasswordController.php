<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    protected function reset(Account $account, string $new_password)
    {
        $account->forceFill([
            'password' => Hash::make($new_password)
        ])->setRememberToken(Str::random(60));

        $account->save();
        event(new PasswordReset($account));
    }

    public function handle(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'new_password' => ['required', 'max:40', 'confirmed'],
            'new_password_confirmation' => 'required',
        ]);

        $this->reset($request->user(), $request->input('new_password'));

        return back();
    }
}
