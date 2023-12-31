@extends('layouts.app')

@section('title', 'Account General')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Account</h1>
        <hr>
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('account.characters') }}">Characters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('account/transaction-history') }}">Transaction History</a>
            </li>
        </ul>
        <hr>
        <h2>Account Information</h2>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Account ID</span>
            <span class="col-sm-10">{{ $account->id }}</span>
        </div>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Email</span>
            <span class="col-sm-10">{{ $account->email }}</span>
        </div>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Member since</span>
            <span class="col-sm-10">{{ date('d/m/Y', strtotime($account->creation)) }}</span>
        </div>
        <div class="row mb-3">
            {{-- TODO: add support to this sonner --}}
            <span class="col-sm-2 fw-bold col-form-label">Language</span>
            <span class="col-sm-3">
                <select class="form-select rounded-0" name="" id="">
                    <option value="en">English</option>
                    <option value="pt">Portuguese</option>
                </select>
            </span>
        </div>
        <hr>
        <h2>Change password</h2>
        @include('layouts.errors')
        <form action="{{ route('auth.password.change.post') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <label for="password" class="col-sm-3 col-form-label">Current password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="password" id="password" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="new_password" class="col-sm-3 col-form-label">New password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="new_password" id="new_password" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="new_password_confirmation" class="col-sm-3 col-form-label">Repeat new password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="new_password_confirmation" id="new_password_confirmation" required>
                </div>
            </div>
            <button class="btn btn-dark rounded-0 float-end">CHANGE PASSWORD</button>
        </form>
    </div>
@endsection
