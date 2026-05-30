<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/">NewsApp</a>

        <div class="collapse navbar-collapse show">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </li>

                @auth

                    @verified
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">Новости</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('verify') }}">Подтвердить аккаунт</a>
                        </li>
                    @endverified

                    @admin
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">
                                Админка
                            </a>
                        </li>
                    @endadmin

                @endauth

            </ul>

            <ul class="navbar-nav ms-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <span class="nav-link text-light">
                            {{ auth()->user()->login }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light ms-2">
                                Выйти
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>

<main class="container mt-4 flex-grow-1">
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @yield('content')

    </div>
</main>

@include('partials.footer')

@yield('scripts')

@auth
    @include('partials.notifications.notification')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
