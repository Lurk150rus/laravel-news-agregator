@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <h3 class="mb-4 text-center">Вход</h3>

                <form method="POST" action="/login">
                    @csrf

                    {{-- LOGIN --}}
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input
                            name="login"
                            class="form-control @error('login') is-invalid @enderror"
                            placeholder="Введите логин"
                        >

                        @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input
                            name="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Введите пароль"
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Войти
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="/register" class="text-decoration-none">
                        Нет аккаунта? Регистрация
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
