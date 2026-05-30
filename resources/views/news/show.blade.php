@extends('layouts.app')

@section('content')

<div class="mb-3">
    <a href="{{ route('news') }}" class="text-decoration-none">
        ← Назад к новостям
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">

        <article class="card border-0 shadow-sm">

            <div class="card-body p-4 p-md-5">

                {{-- HEADER --}}
                <h1 class="mb-3">
                    {{ $news->title }}
                </h1>

                {{-- META --}}
                <div class="text-muted small mb-4">
                    <div>
                        <strong>Источник:</strong> {{ $news->source }}
                    </div>
                    <div>
                        <strong>Получено:</strong> {{ $news->received_at ?? $news->created_at }}
                    </div>
                </div>

                <hr>

                {{-- CONTENT --}}
                <div class="mt-4 fs-5 lh-lg">
                    {{ $news->content }}
                </div>

            </div>

        </article>

    </div>
</div>

@endsection
