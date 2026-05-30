@extends('admin.layout')

@section('content')

<h1>Verification Codes</h1>

<table border="1" cellpadding="5">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Code</th>
        <th>Sent At</th>
        <th>Confirmed At</th>
        <th>Expires At</th>
    </tr>
    </thead>

    <tbody>
    @foreach($codes as $code)
        <tr>
            <td>{{ $code->id }}</td>
            <td>{{ $code->user?->login }}</td>
            <td>{{ $code->code }}</td>
            <td>{{ $code->sent_at }}</td>
            <td>{{ $code->verified_at }}</td>
            <td>{{ $code->expires_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $codes->links() }}

@endsection
