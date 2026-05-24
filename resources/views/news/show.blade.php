@extends('layouts.app')

@section('content')

<a href="/news">← Back</a>

<article style="margin-top: 20px;">
    <h1>{{ $news->title }}</h1>

    <p style="color: gray;">
        Source: {{ $news->source }} <br>
        Received: {{ $news->received_at ?? $news->created_at }}
    </p>

    <hr>

    <div>
        {{ $news->content }}
    </div>
</article>

@endsection
