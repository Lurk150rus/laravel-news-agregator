<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>
<body>

    <h1>News</h1>

    <form method="GET" action="{{ url('/news') }}">
        <input
            type="text"
            name="search"
            placeholder="Search..."
            value="{{ request('search') }}"
        >

        <button type="submit">
            Search
        </button>
    </form>

    <hr>

    @forelse($news as $item)

        <article style="margin-bottom: 30px;">

            <h2>
                {{ $item->title }}
            </h2>

            <p>
                {{ $item->description }}
            </p>

            <small>
                Source: {{ $item->source }}
            </small>

            <br>

            <small>
                Published:
                {{ $item->published_at }}
            </small>

        </article>

    @empty

        <p>No news found.</p>

    @endforelse

    <div>
        {{ $news->links() }}
    </div>

</body>
</html>
