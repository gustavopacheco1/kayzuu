@extends('layouts.app')

@section('title', 'Register')

@section('content_header')
<h1>Register</h1>
@endsection

@section('content')
@include('layouts.errors')
<form action="{{ route('auth.register.post') }}" method="POST">
    @csrf
    <div>
        <label for="name">Account name</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <input type="submit" value="Submit">
</form>
@endsection
