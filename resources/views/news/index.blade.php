@extends('layouts.app')

@section('title', 'News')

@section('content_header')
@endsection

@section('content')
    <div class="card mx-auto mt-5 p-4 col-sm-8">
        <h1>News</h1>
        <hr>
        @foreach ($newses as $news)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $news->title }}</h5>
                    <p class="card-text">
                        {!! $news->content !!}
                    </p>
                    <hr>
                    <span class="text-secondary">{{ date('d/m/Y', strtotime($news->created_at)) }}</span>
                    @if ($isAdmin)
                        <a class="float-end" href="{{ route('news.edit', [$news->id]) }}">Edit</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
