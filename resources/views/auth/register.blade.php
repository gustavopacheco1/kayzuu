@extends('layouts.app')

@section('content_header')
<h1>Register</h1>
@endsection

@section('content')
<form action="register/handle" method="POST">
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
