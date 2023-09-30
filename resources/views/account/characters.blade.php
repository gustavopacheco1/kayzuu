@extends('layouts.app')

@section('title', 'Account Characters')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Account</h1>
        <hr>
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('account.general') }}">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Characters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('account/transaction-history') }}">Transaction History</a>
            </li>
        </ul>
        <hr>
        <h2>Characters</h2>
        <div class="row">
            @foreach ($characters as $character)
                <div class="col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $character->name }}
                                <span class="text-primary fw-bold">({{ $character->vocation_name }})</span>
                            </h5>
                            <p class="card-text">
                                Level: <span class="text-primary fw-bold">{{ $character->level }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-4 mb-3">
                <a href="{{ route('player.create') }}"
                    class="card text-decoration-none text-primary border-2 border-primary">
                    <div class="card-body text-center">
                        <h1 class="card-title">+</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
