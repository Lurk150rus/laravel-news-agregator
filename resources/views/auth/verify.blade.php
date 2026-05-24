@extends('layouts.app')

@section('content')

<h1>Verify account</h1>

<form method="POST" action="/verify">
    @csrf

    <input name="login" placeholder="login" value="{{ old('login') }}">
    @error('login') <div style="color:red">{{ $message }}</div> @enderror

    <input name="code" placeholder="code">
    @error('code') <div style="color:red">{{ $message }}</div> @enderror

    <button type="submit">Verify</button>
</form>

<form method="POST" action="/verify/resend" style="margin-top:10px;">
    @csrf
    <input name="login" placeholder="login">
    <button type="submit">Resend code</button>
</form>

@endsection
