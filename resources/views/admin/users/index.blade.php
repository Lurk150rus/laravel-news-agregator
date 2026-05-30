@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Пользователи</h2>
</div>

<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0 align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Верифицирован</th>
                        <th>Админ</th>
                        <th>Регистрация</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr>
                        <td class="text-muted">{{ $user->id }}</td>

                        <td>
                            <strong>{{ $user->login }}</strong>
                        </td>

                        <td>
                            @if($user->is_verified)
                                <span class="badge bg-success">Да</span>
                            @else
                                <span class="badge bg-secondary">Нет</span>
                            @endif
                        </td>

                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-light text-dark">User</span>
                            @endif
                        </td>

                        <td class="text-muted">
                            {{ $user->created_at }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Пользователи отсутствуют
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
    {{ $users->links() }}
</div>

@endsection
