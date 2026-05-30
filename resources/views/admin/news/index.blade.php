@extends('admin.layout')

@section('content')

<h1>News</h1>

<table border="1" cellpadding="5">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Source</th>
        <th>Received At</th>
    </tr>
    </thead>

    <tbody>
    @foreach($news as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->source }}</td>
            <td>{{ $item->received_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $news->links() }}

@endsection
