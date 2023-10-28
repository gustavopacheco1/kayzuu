@extends('layouts.app')

@section('title', 'Guild Create')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>Create news</h1>
        <hr>
        @include('layouts.errors')
        <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <div class="mb-3 form-group">
                <label for="title">Title</label>
                <input class="form-control rounded-0" type="text" name="title" id="title">
            </div>
            <div class="mb-3 form-group">
                <label for="content">Content</label>
                <textarea class="form-control rounded-0" name="content" id="content" placeholder="Insert HTML text here." rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary rounded-0">Submit</button>
        </form>
    </div>
@endsection
