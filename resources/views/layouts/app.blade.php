<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News App</title>
</head>
<body>

    <header style="margin-bottom: 20px;">
        <a href="/">Home</a>
        @auth

        @verified
        <a href="{{ route('news') }}">News</a>
        @else
        <a href="/verify">Verify account</a>
        @endverified

        <span style="margin-left: 10px;">
            {{ auth()->user()->login }}
        </span>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth
        @admin
        <a href="{{ route('admin.dashboard') }}" style="margin-left: 10px">Admin Panel</a>
        @endadmin
        @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endguest
    </header>

    <hr>

    <main>
        @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
        @endif

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

    @yield('scripts')
    @include('partials.notifications.notification')
</body>
</html>
