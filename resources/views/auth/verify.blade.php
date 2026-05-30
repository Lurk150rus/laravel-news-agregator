@extends('layouts.app')

@section('content')

<h1>Verify account</h1>

<form method="POST" action="/verify">
    @csrf

    <input name="code" placeholder="code">

    @error('code')
    <div style="color:red">{{ $message }}</div>
    @enderror

    <button type="submit">Verify</button>
</form>

<form method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <input type="hidden" name="login" value="{{ auth()->user()->login }}">
    <button type="submit">Resend code</button>
</form>
@endsection
