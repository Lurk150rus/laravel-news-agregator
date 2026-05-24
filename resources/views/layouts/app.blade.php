<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News App</title>
</head>
<body>

    <header style="margin-bottom: 20px;">
        <a href="/">Home</a>
        <a href="/news">News</a>

        @auth
        <span style="margin-left: 10px;">
            {{ auth()->user()->login }}
        </span>

        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth

        @guest
        <a href="/login">Login</a>
        <a href="/register">Register</a>
        @endguest
    </header>

    <hr>

    <main>
        @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
