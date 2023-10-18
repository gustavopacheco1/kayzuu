@extends('layouts.app')

@section('title', 'Highscore')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Highscore</h1>
        <hr>
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => $skillType == 0]) href="{{ route('player.highscore') }}">Level</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::MAGLEVEL->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::MAGLEVEL->value) }}">Magic Level</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::FIST->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::FIST->value) }}">Fist</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::CLUB->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::CLUB->value) }}">Club</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::SWORD->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::SWORD->value) }}">Sword</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::AXE->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::AXE->value) }}">Axe</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::DIST->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::DIST->value) }}">Distance</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::SHIELDING->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::SHIELDING->value) }}">Shielding</a>
            </li>
            <li class="nav-item">
                <a @class([
                    'nav-link',
                    'active' => $skillType == \App\Enums\SkillTypeEnum::FISHING->value,
                ])
                    href="{{ route('player.highscore', \App\Enums\SkillTypeEnum::FISHING->value) }}">Fishing</a>
            </li>
        </ul>
        <hr>
        <table class="table caption-top text-center">
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
                        <td>{{ $player->skill }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
