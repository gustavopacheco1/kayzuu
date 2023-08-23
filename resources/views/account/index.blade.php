@extends('layouts.app')

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
                <a class="nav-link" href="{{ url('account/characters') }}">Characters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('account/transaction-history') }}">Transaction History</a>
            </li>
        </ul>
        <hr>
        <h2>Account Information</h2>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Account ID</span>
            <span class="col-sm-10">{{ $id }}</span>
        </div>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Email</span>
            <span class="col-sm-10">{{ $email }}</span>
        </div>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Member since</span>
            <span class="col-sm-10">{{ $created_at }}</span>
        </div>
        <div class="row mb-3">
            <span class="col-sm-2 fw-bold">Language</span>
            <span class="col-sm-3">
                <select class="form-select rounded-0" name="" id="">
                    <option value="en">English</option>
                    <option value="pt">Portuguese</option>
                </select>
            </span>
        </div>
        <hr>
        <h2>Change password</h2>
        <form action="" method="POST">
            @csrf
            <div class="row mb-3">
                <label for="current_password" class="col-sm-3 col-form-label">Current password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="current_password" id="current_password">
                </div>
            </div>
            <div class="row mb-3">
                <label for="new_password" class="col-sm-3 col-form-label">New password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="new_password" id="new_password">
                </div>
            </div>
            <div class="row mb-3">
                <label for="repeat_new_password" class="col-sm-3 col-form-label">Repeat new password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control rounded-0" name="repeat_new_password"
                        id="repeat_new_password">
                </div>
            </div>
            <button class="btn btn-dark rounded-0 float-end">CHANGE PASSWORD</button>
        </form>
    </div>
@endsection
