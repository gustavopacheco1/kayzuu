<?php

namespace App\Http\Middleware;

use App\Enums\AccountTypeEnum;
use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next, string $guard = null): Response
    {
        if (Auth::guard($guard)->guest()) {
            return response()->redirectTo(route('auth.login'));
        }

        /** @var Account $account */
        $account = auth()->user();

        if ($account->type != AccountTypeEnum::GOD->value) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
