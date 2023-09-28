@extends('layouts.app')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Download</h1>
        <hr>
        <div class="row">
            @if ($clients_url['windows'])
                <a href="{{ $clients_url['windows'] }}">
                    Download for Windows
                </a>
            @endif

            @if ($clients_url['linux'])
                <a href="{{ $clients_url['linux'] }}">
                    Download for Linux
                </a>
            @endif

            @if ($clients_url['mac'])
                <a href="{{ $clients_url['mac'] }}">
                    Download for Mac
                </a>
            @endif
        </div>
    </div>
@endsection
