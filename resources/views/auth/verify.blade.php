@extends('layouts.app')

@section('content')

<h1>Verify account</h1>

<form method="POST" action="/verify">
    @csrf

    <input name="code" placeholder="code">

    @error('code')
    <div style="color:red">{{ $message }}</div>
    @enderror

    <form method="POST" action="/verify/resend">
        @csrf
        <button>Resend code</button>
    </form>
    
    <button type="submit">Verify</button>
</form>
@endsection
