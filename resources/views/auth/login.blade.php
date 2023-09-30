@extends('layouts.app')

@section('title', 'Login')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-8">
        <h1>Login</h1>
        <hr>
        @include('layouts.errors')
        <form action="{{ route('auth.login.post') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Account name</label>
                <div class="col-sm-10">
                    <input class="form-control rounded-0" required type="text" name="name" id="name">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="password">Password</label>
                <div class="col-sm-10">
                    <input class="form-control rounded-0" required type="password" name="password" id="password">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input rounded-0" type="checkbox" value="1" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember
                        </label>
                    </div>

                </div>
            </div>

            <input class="btn btn-primary rounded-0 float-end" type="submit" value="Submit">
        </form>

    </div>
@endsection
