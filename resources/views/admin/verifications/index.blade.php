@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Коды подтверждения</h2>
</div>

<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0 align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Код</th>
                        <th>Отправлен</th>
                        <th>Подтверждён</th>
                        <th>Истекает</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($codes as $code)

                    <tr>

                        <td class="text-muted">
                            {{ $code->id }}
                        </td>

                        <td>
                            <strong>{{ $code->user?->login ?? '—' }}</strong>
                        </td>

                        <td>
                            <code>{{ $code->code }}</code>
                        </td>

                        <td class="text-muted">
                            {{ $code->sent_at ?? '—' }}
                        </td>

                        <td>
                            @if($code->verified_at)
                                <span class="badge bg-success">OK</span>
                            @else
                                <span class="badge bg-warning text-dark">NO</span>
                            @endif
                        </td>

                        <td class="text-muted">
                            {{ $code->expires_at }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Коды отсутствуют
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
    {{ $codes->links() }}
</div>

@endsection
