<footer class="bg-white border-top mt-auto">
    <div class="container py-3">

        <div class="row align-items-center">

            {{-- STATS --}}
            <div class="col-md-6 text-muted small">

                <span class="me-3">
                    👥 Пользователи:
                    <strong>{{ $adminStats['users'] }}</strong>
                </span>

                <span class="me-3">
                    ⏳ Не подтверждены:
                    <strong>{{ $adminStats['unverified'] }}</strong>
                </span>

                <span>
                    📰 Новости:
                    <strong>{{ $adminStats['news'] }}</strong>
                </span>

            </div>

            {{-- QUICK NAV --}}
            <div class="col-md-6 text-md-end mt-2 mt-md-0">

                <a href="{{ route('admin.users.index') }}" class="text-decoration-none me-3">
                    Пользователи
                </a>

                <a href="{{ route('admin.verifications.index') }}" class="text-decoration-none me-3">
                    Верификации
                </a>

                <a href="{{ route('admin.news.index') }}" class="text-decoration-none me-3">
                    Новости
                </a>

                <a href="{{ route('news') }}" class="text-decoration-none text-primary">
                    Портал
                </a>

            </div>

        </div>

    </div>
</footer>
