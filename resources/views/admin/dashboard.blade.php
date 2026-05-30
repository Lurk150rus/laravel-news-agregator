@extends('admin.layout')

@section('content')

<h2 class="mb-4">Админ-панель</h2>

{{-- STATS CARDS --}}
<div class="row g-3">

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Пользователи</h6>
                <h2 class="mb-0">{{ $usersCount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Новости</h6>
                <h2 class="mb-0">{{ $newsCount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Коды верификации</h6>
                <h2 class="mb-0">{{ $verificationsCount }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="mt-5">

    <h5 class="mb-3">Сущности:</h5>

    <div class="list-group shadow-sm">

        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
            👤 Пользователи
        </a>

        <a href="{{ route('admin.news.index') }}" class="list-group-item list-group-item-action">
            📰 Новости
        </a>

        <a href="{{ route('admin.verifications.index') }}" class="list-group-item list-group-item-action">
            🔐 Верификации
        </a>

    </div>

</div>

@endsection
