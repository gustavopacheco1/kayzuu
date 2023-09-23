@extends('layouts.app')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Search player</h1>
        <hr>
        <form action="{{ route('player.find') }}" method="GET">
            <div class="row">
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control rounded-0" placeholder="PLAYER NAME" required>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-dark rounded-0" type="submit">SEARCH</button>
                </div>
            </div>
        </form>
    </div>
@endsection
