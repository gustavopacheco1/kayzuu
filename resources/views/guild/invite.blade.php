@extends('layouts.app')

@section('title', "{$guild->name} - Invite")

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <span>
            <a href="{{ route('guild.show', ['id' => $guild->id]) }}"><- Back</a>
        </span>
        <h1>{{ $guild->name }} - Invite</h1>
        <hr>
        @include('layouts.errors')
        <form action="{{ route('guild.invite.post', ['id' => $guild->id]) }}" method="POST">
            @csrf
            <div class="col-sm-6 mx-auto">
                <div class="row mb-3">
                    <input type="text" class="form-control" name="player_name" id="player_name" placeholder="PLAYER" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-block btn-primary p-0 mx-auto">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
