<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>

<nav>
    <a href="{{ route('admin.users.index') }}">Users</a> |
    <a href="{{ route('admin.verifications.index') }}">Verifications</a> |
    <a href="{{ route('admin.news.index') }}">News</a> |
    <a href="{{ route('news') }}" style="margin-left: 10px">Portal</a>
</nav>

<hr>

@yield('content')

@auth
    @include('partials.notifications.notification')
@endauth
</body>
</html>
