<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                Admin Panel
                <span class="badge bg-warning text-dark ms-2">
                    ADMIN
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNav">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            Пользователи
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.verifications.index') }}">
                            Верификации
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.news.index') }}">
                            Новости
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('news') }}">
                            ← Портал
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="container py-4 flex-grow-1">
        <div class="bg-white rounded-3 shadow-sm p-4">
            @yield('content')
        </div>
    </div>

    {{-- NOTIFICATIONS --}}
    @auth
    @include('partials.notifications.notification')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ADMIN FOOTER --}}
    @include('admin.partials.footer')
</body>
</html>
