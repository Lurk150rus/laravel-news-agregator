@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <h3 class="mb-4 text-center">Регистрация</h3>

                <form method="POST" action="/register">
                    @csrf

                    {{-- LOGIN --}}
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input
                            name="login"
                            class="form-control @error('login') is-invalid @enderror"
                            placeholder="Придумайте логин"
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
                            placeholder="Придумайте пароль"
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Зарегистрироваться
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        Уже есть аккаунт? Войти
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
