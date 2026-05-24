@extends('layouts.app')

@section('content')

<h1>Register</h1>

<form method="POST" action="/register">
    @csrf

    <input name="login" placeholder="login">
    @error('login')
        <div style="color:red;">{{ $message }}</>
    @enderror
    <input name="password" type="password" placeholder="password">
    @error('password')
        <div style="color:red;">{{ $message }}</>
    @enderror
    <button type="submit">Register</button>
</form>

<a href="/login">Login</a>

@endsection
