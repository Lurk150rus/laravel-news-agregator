@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <h3 class="mb-3 text-center">Подтверждение аккаунта</h3>

                <p class="text-muted text-center mb-4">
                    Введите код подтверждения, который был отправлен в уведомления.
                </p>

                {{-- VERIFY FORM --}}
                <form method="POST" action="/verify">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Код подтверждения</label>

                        <input
                            name="code"
                            class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                            placeholder="••••••"
                            maxlength="6"
                        >

                        @error('code')
                            <div class="invalid-feedback text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Подтвердить
                    </button>
                </form>

                <hr class="my-4">

                {{-- RESEND --}}
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <input type="hidden" name="login" value="{{ auth()->user()->login }}">

                    <button type="submit" class="btn btn-outline-primary w-100">
                        Отправить код повторно
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>

@endsection
