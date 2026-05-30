@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Новости</h2>
</div>

{{-- SEARCH + FILTER --}}
<div class="row mb-4">
    <div class="col-md-6">

        <form method="GET" action="/news" id="filter-form">

            <div class="input-group mb-2">
                <input
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Поиск новостей..."
                    autocomplete="off"
                >

                <button class="btn btn-outline-primary" type="submit">
                    Найти
                </button>
            </div>

            <select name="source" class="form-select">
                <option value="">Все источники</option>
                <option value="hacker_news" @selected(request('source')=='hacker_news')>
                    Hacker News
                </option>
            </select>

            <div class="mt-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-primary">Фильтр</button>
                <button type="reset" class="btn btn-sm btn-outline-secondary">Сброс</button>
            </div>

        </form>

        {{-- SUGGESTIONS --}}
        <div id="suggestions" class="list-group position-absolute w-50 shadow-sm" style="display:none; z-index: 1000;"></div>

    </div>
</div>

{{-- NEWS --}}
<div class="row g-3">

    @forelse($news as $item)

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">

                <div class="card-body">

                    <h5 class="card-title">
                        <a href="{{ route('news.show', $item) }}" class="text-decoration-none">
                            {{ $item->title }}
                        </a>
                    </h5>

                    <p class="card-text text-muted">
                        {{ $item->description }}
                    </p>

                </div>

                <div class="card-footer bg-white border-0 text-muted small">
                    <div>Источник: <strong>{{ $item->source }}</strong></div>
                    <div>Дата: {{ $item->received_at ?? $item->created_at }}</div>
                </div>

            </div>
        </div>

    @empty

        <div class="col-12">
            <div class="alert alert-warning">
                Новости не найдены
            </div>
        </div>

    @endforelse

</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $news->links() }}
</div>

@endsection

@section('scripts')
<script>
let timer = null;

const input = document.getElementById('search');
const box = document.getElementById('suggestions');
const form = document.getElementById('filter-form');

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
                    <button type="button"
                        class="list-group-item list-group-item-action suggestion-item"
                        data-title="${item.title}">
                        ${item.title}
                    </button>
                `).join('');

                box.style.display = 'block';
            });

    }, 200);
});

// click suggestion
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('suggestion-item')) {
        input.value = e.target.dataset.title;
        box.style.display = 'none';
    } else {
        box.style.display = 'none';
    }
});

// reset
form.querySelector('button[type="reset"]').addEventListener('click', function (e) {
    e.preventDefault();
    input.value = '';
    box.style.display = 'none';
    box.innerHTML = '';
});
</script>
@endsection
