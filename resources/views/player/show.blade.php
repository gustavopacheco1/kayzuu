@extends('layouts.app')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>{{ $player->name }} <span class="fw-bold text-primary">({{ $player->vocation }})</span></h1>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <span class="col-sm-4 fw-bold">Level</span>
                    <span class="col-sm-8">{{ $player->level }}</span>
                </div>
                <div class="row">
                    <span class="col-sm-4 fw-bold">Guild</span>
                    <span class="col-sm-8">{{ $player->guild_id }}</span>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Fist</span>
                            <span class="col-sm-8">{{ $player->skill_fist }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Club</span>
                            <span class="col-sm-8">{{ $player->skill_club }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Sword</span>
                            <span class="col-sm-8">{{ $player->skill_sword }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Axe</span>
                            <span class="col-sm-8">{{ $player->skill_axe }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Dist</span>
                            <span class="col-sm-8">{{ $player->skill_dist }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Shield</span>
                            <span class="col-sm-8">{{ $player->skill_shielding }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-4 fw-bold">Fishing</span>
                            <span class="col-sm-8">{{ $player->skill_fishing }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
