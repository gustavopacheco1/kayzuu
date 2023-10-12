@extends('layouts.app')

@section('title', $guild->name)

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>{{ $guild->name }}</h1>
        <hr>
        @if ($isOwner)
            <div class="row">
                <h2>Actions</h2>
                <div class="col-sm-2">
                    <a class="btn btn-primary d-inline-block rounded-0"
                        href="{{ route('guild.invite', [$guild->id]) }}">Invite player</a>
                </div>
            </div>
            <hr>
        @endif
        <h2>Members</h2>
        @include('layouts.errors')
        <table class="table caption-top text-center">
            <caption>List of all guild members</caption>
            <thead>
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Name</th>
                    <th scope="col">Vocation</th>
                    <th scope="col">Level</th>
                    <th scope="col">Status</th>
                    @if ($isOwner)
                        <th scope="col">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($guild->members as $member)
                    <tr>
                        <th scope="row">{{ $member->membership->rank->name }}</th>
                        <td><a href="{{ route('player.show', [$member->id]) }}">{{ $member->name }}</a></td>
                        <td><span class="text-primary fw-bold">{{ $member->vocation_name }}</span></td>
                        <td>{{ $member->level }}</td>
                        <td>
                            @if ($member->online)
                                <span class="text-success">Online</span>
                            @else
                                <span class="text-danger">Offline</span>
                            @endif
                        </td>
                        @if ($isOwner)
                            <td>
                                <form method="POST" action="{{ route('guild.kick', ['guild' => $guild->id, 'player' => $member->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-danger mx-1" type="submit">Kick</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($guild->invites()->count() > 0)
            <hr>
            <h2>Invites</h2>
            <table class="table caption-top text-center">
                <caption>List of all pending invites</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Player</th>
                        <th scope="col">Level</th>
                        <th scope="col">Vocation</th>
                        @if ($isOwner)
                            <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guild->invites as $invite)
                        @php
                            $isCharacterOwner = $invite->player->account_id == Auth::id();
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a
                                    href="{{ route('player.show', [$invite->player->id]) }}">{{ $invite->player->name }}</a>
                            </td>
                            <td>{{ $invite->player->level }}</td>
                            <td><span class="fw-bold text-primary">{{ $invite->player->vocation_name }}</span></td>
                            @if ($isOwner || $isCharacterOwner)
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if ($isCharacterOwner)
                                            <form method="POST"
                                                action="{{ route('guild.invite.accept', ['guild' => $guild->id, 'player' => $invite->player->id]) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-success mx-1" type="submit">Accept</button>
                                            </form>
                                        @endif
                                        <form method="POST"
                                            action="{{ route('guild.invite.cancel', ['guild' => $guild->id, 'player' => $invite->player->id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-sm btn-danger mx-1" type="submit">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
