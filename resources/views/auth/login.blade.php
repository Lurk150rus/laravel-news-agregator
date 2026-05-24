@extends('layouts.app')

@section('content')

<h1>Login</h1>

<form method="POST" action="/login">
    @csrf

    <input name="login" placeholder="login">
    @error('login')
        <div style="color:red;">{{ $message }}</>
    @enderror
    <input name="password" type="password" placeholder="password">
    @error('password')
        <div style="color:red;">{{ $message }}</>
    @enderror
    <button type="submit">Login</button>
</form>

<a href="/register">Register</a>

@endsection
