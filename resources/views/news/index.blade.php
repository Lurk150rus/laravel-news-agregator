@extends('layouts.app')

@section('content')

<h1>News</h1>

<!-- SEARCH + FILTER -->
<div style="position: relative; width: 300px; margin-bottom: 20px;">

    <form method="GET" action="/news" id="filter-form">
        <input
            name="search"
            id="search"
            value="{{ request('search') }}"
            placeholder="Search news..."
            autocomplete="off"
            style="width: 100%; padding: 6px;"
        >

        <select name="source" style="margin-top: 10px; width: 100%;">
            <option value="">All sources</option>
            <option value="hacker_news" @selected(request('source')=='hacker_news')>
                Hacker News
            </option>
        </select>

        <button type="submit" style="margin-top: 10px;">Filter</button>
        <button type="reset" style="margin-top: 10px;">Reset</button>
    </form>

    <!-- AUTOCOMPLETE BOX -->
    <div
        id="suggestions"
        style="
            display:none;
            position:absolute;
            top: 35px;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ddd;
            z-index: 1000;
        "
    ></div>

</div>

<hr>

<!-- NEWS LIST -->
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


@section('scripts')
<script>
let timer = null;

const form = document.getElementById('filter-form');
const input = document.getElementById('search');
const box = document.getElementById('suggestions');
const reset = form.querySelector('button[type="reset"]');

input.addEventListener('input', function (e) {
    clearTimeout(timer);

    const query = e.target.value.trim();

    if (!query) {
        box.style.display = 'none';
        box.innerHTML = '';
        return;
    }

    timer = setTimeout(() => {
        fetch(`/news/search?search=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {

                if (!data.length) {
                    box.style.display = 'none';
                    return;
                }

                box.innerHTML = data.map(item => `
                    <div class="suggestion-item"
                         data-id="${item.id}"
                         style="padding:8px; cursor:pointer; border-bottom:1px solid #eee;">
                        ${item.title}
                    </div>
                `).join('');

                box.style.display = 'block';
            });
    }, 200);
});

// click on suggestion
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('suggestion-item')) {
        input.value = e.target.innerText.trim();;
        box.style.display = 'none';

        // optional: auto submit filter form
        // document.getElementById('filter-form').submit();
    } else {
        box.style.display = 'none';
    }
});

reset.addEventListener('click', function (e) {
    e.preventDefault();
    input.value = '';
    box.style.display = 'none';
    box.innerHTML = '';
});
</script>
@endsection
