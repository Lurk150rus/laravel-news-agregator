@extends('layouts.app')

@section('content')

<h1>News</h1>

<form method="GET" action="/news" style="margin-bottom: 20px;">
    <input name="search" value="{{ request('search') }}" placeholder="Search news...">

    <select name="source">
        <option value="">All sources</option>
        <option value="hacker_news" @selected(request('source')=='hacker_news' )>
            Hacker News
        </option>
    </select>

    <button type="submit">Filter</button>
</form>

<hr>

@forelse($news as $item)

<article style="margin-bottom: 20px; padding: 10px; border: 1px solid #ddd;">
    <h2>
        <a href="{{ route('news.show', $item) }}">
            {{ $item->title }}
        </a>
    </h2>
    <p>{{ $item->description }}</p>

    <small>
        Source: <strong>{{ $item->source }}</strong><br>
        Date: {{ $item->received_at ?? $item->created_at }}
    </small>
</article>

@empty
<p>No news found</p>
@endforelse

<div>
    {{ $news->links() }}
</div>

@endsection
