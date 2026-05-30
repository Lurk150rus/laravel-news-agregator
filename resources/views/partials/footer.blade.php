<footer class="bg-dark text-light mt-5 pt-5 pb-4">
    <div class="container">

        <div class="row g-4">

            {{-- О проекте --}}
            <div class="col-md-4">
                <h5 class="mb-3">News Aggregator</h5>
                <p class="text-white">
                    Backend-focused проект новостного агрегатора с авторизацией,
                    верификацией пользователей, импортом новостей и realtime-уведомлениями.
                </p>
            </div>

            {{-- Навигация --}}
            <div class="col-md-4">
                <h6 class="mb-3 text-uppercase text-secondary">Навигация</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-decoration-none text-light">Главная</a></li>
                    <li><a href="/news" class="text-decoration-none text-light">Новости</a></li>

                    @auth
                        <li><a href="/verify" class="text-decoration-none text-light">Верификация</a></li>
                    @endauth

                    @admin
                        <li><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-warning">
                            Админка
                        </a></li>
                    @endadmin
                </ul>
            </div>

            {{-- Тех инфо --}}
            <div class="col-md-4">
                <h6 class="mb-3 text-uppercase text-secondary">Технологии</h6>

                <ul class="list-unstyled text-white">
                    <li>Laravel</li>
                    <li>MySQL</li>
                    <li>Queues (RabbitMQ ready)</li>
                    <li>SSE realtime</li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary mt-4">

        <div class="d-flex justify-content-between align-items-center">

            <small class="text-white">
                © {{ date('Y') }} News Aggregator
            </small>

            <small class="text-white">
                Backend architecture project
            </small>

        </div>

    </div>
</footer>
