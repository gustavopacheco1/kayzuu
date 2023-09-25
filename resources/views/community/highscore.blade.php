@extends('layouts.app')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Highscore</h1>
        <hr>
        <table class="table caption-top text-center">
            <caption>List of top level players</caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Vocation</th>
                    <th scope="col">Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $player->name }}</td>
                        <td><span class="fw-bold text-primary">{{ $player->vocation_name }}</span></td>
                        <td>{{ $player->level }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
