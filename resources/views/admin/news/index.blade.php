@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Новости</h2>
</div>

<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0 align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Источник</th>
                        <th>Дата получения</th>
                        <th>Дата публикации</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($news as $item)
                    <tr>
                        <td class="text-muted">
                            {{ $item->id }}
                        </td>

                        <td>
                            <strong>{{ $item->title }}</strong>
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $item->source }}
                            </span>
                        </td>

                        <td class="text-muted">
                            {{ $item->received_at }}
                        </td>

                        <td class="text-muted">
                            {{ $item->published_at ?? '-'}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Новости отсутствуют
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- PAGINATION --}}
<div class="mt-3">
    {{ $news->links() }}
</div>

@endsection
