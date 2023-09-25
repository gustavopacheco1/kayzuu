@extends('layouts.app')

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
                <a class="nav-link active" aria-current="page" href="{{ route('account.characters') }}">Characters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('account/transaction-history') }}">Transaction History</a>
            </li>
        </ul>
        <hr>
        <h2 class="mb-3 mx-auto">Create character</h2>
        @include('layouts.errors')
        <form action="{{ route('player.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-6 mx-auto">
                    <input type="text" class="form-control rounded-0" name="name" id="name" placeholder="NAME" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 mx-auto">
                    <select name="vocation" id="vocation" class="form-select rounded-0" required>
                        <option selected disabled>SELECT VOCATION</option>
                        @foreach ($vocations as $id => $vocation)
                            @if ($vocation['createable'])
                                <option value="{{ $id }}">{{ $vocation['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-dark rounded-0 col-sm-3 mx-auto">CREATE CHARACTER</button>
            </div>
        </form>
    </div>
@endsection
