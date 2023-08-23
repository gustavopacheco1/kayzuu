<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected string $redirectTo = RouteServiceProvider::HOME;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:32'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:40'],
        ]);
    }

    protected function create(array $data): Account
    {
        return Account::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => hash('sha1', $data['password']),
        ]);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function handle(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());

        return redirect($this->redirectTo);
    }
}
