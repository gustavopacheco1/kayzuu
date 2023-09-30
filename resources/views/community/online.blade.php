@extends('layouts.app')

@section('title', 'Players Online')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Players Online</h1>
        <hr>
        <table class="table caption-top text-center">
            @if ($players->count() > 0)
                <caption>List of all the currently online players</caption>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Vocation</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($players->all() as $player)
                        <tr>
                            <td><a href="{{ url("player/$player->id") }}">{{ $player->name }}</a></td>
                            <td><span class="fw-bold text-primary">{{ $player->vocation_name }}</span></td>
                            <td>{{ $player->level }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <caption>There are no players online</caption>
            @endif
        </table>
    </div>
@endsection
