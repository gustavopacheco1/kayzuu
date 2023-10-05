@extends('layouts.app')

@section('title', 'Guilds')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm-4">
                <h1>Guilds</h1>
            </div>
            @auth
                <div class="col-sm-4">
                    <a href="{{ route('guild.create') }}" class="btn btn-primary float-end rounded-0">Create</a>
                </div>
            @endauth
        </div>
        <hr>
        <table class="table caption-top text-center">
            <caption>List of all guilds</caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guilds as $guild)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><a href="{{ route('guild.show', ['id' => $guild->id]) }}">{{ $guild->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
