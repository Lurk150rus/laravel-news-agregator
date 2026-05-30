@extends('layouts.app')

@section('content')

<div class="p-4 p-md-5 mb-4 bg-white rounded shadow-sm">

    <div class="col-lg-8 px-0">

        <h1 class="display-5 fw-bold">
            News Aggregator
        </h1>

        <p class="lead my-3 text-muted">
            Система агрегации новостей с авторизацией, верификацией пользователей,
            импортом новостей и realtime-уведомлениями.
        </p>

        <a href="/news" class="btn btn-primary btn-lg">
            Перейти к новостям
        </a>

    </div>

</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📰 Новости</h5>
                <p class="card-text text-muted">
                    Получай актуальные новости из внешних источников и базы данных.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">🔐 Авторизация</h5>
                <p class="card-text text-muted">
                    Регистрация с подтверждением аккаунта через код.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">⚡ Realtime</h5>
                <p class="card-text text-muted">
                    Уведомления о новых пользователях и новостях в реальном времени.
                </p>
            </div>
        </div>
    </div>

</div>


@endsection
