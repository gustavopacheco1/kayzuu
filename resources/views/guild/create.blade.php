@extends('layouts.app')

@section('title', 'Guild Create')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Guild Create</h1>
        <hr>
        @include('layouts.errors')
        <form action="{{ route('guild.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-6 mx-auto">
                    <select name="ownerid" id="ownerid" class="form-select rounded-0" required>
                        <option selected disabled>SELECT OWNER</option>
                        @foreach ($characters as $character)
                            <option value="{{ $character->id }}">{{ $character->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 mx-auto">
                    <input type="text" class="form-control rounded-0" name="name" id="name" placeholder="NAME" required>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-dark rounded-0 col-sm-3 mx-auto">CREATE GUILD</button>
            </div>
        </form>
    </div>
@endsection
