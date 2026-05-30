@extends('admin.layout')

@section('content')

<h1>Admin Dashboard</h1>

<div style="display: flex; gap: 20px; margin-top: 20px;">

    <div style="border: 1px solid #ddd; padding: 15px; min-width: 150px;">
        <h3>Users</h3>
        <p style="font-size: 24px; margin: 0;">{{ $usersCount }}</p>
    </div>

    <div style="border: 1px solid #ddd; padding: 15px; min-width: 150px;">
        <h3>News</h3>
        <p style="font-size: 24px; margin: 0;">{{ $newsCount }}</p>
    </div>

    <div style="border: 1px solid #ddd; padding: 15px; min-width: 150px;">
        <h3>Verification Codes</h3>
        <p style="font-size: 24px; margin: 0;">{{ $verificationsCount }}</p>
    </div>

</div>

<hr style="margin: 30px 0;">

<h2>Quick Links</h2>

<ul>
    <li><a href="{{ route('admin.users.index') }}">Users list</a></li>
    <li><a href="{{ route('admin.news.index') }}">News list</a></li>
    <li><a href="{{ route('admin.verifications.index') }}">Verification codes</a></li>
</ul>

@endsection
