@extends('admin.layout')

@section('content')

<h1>Users</h1>

<table border="1" cellpadding="5">
    <thead>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Verified</th>
        <th>Admin</th>
        <th>Registered</th>
    </tr>
    </thead>

    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->login }}</td>
            <td>{{ $user->is_verified ? 'Yes' : 'No' }}</td>
            <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links() }}

@endsection
