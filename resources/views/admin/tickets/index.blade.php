@extends('layouts.admin')

@section('title', 'Заявки')

@section('content')
    <h4 class="mb-3">Заявки</h4>

    <form method="GET" action="{{ route('admin.tickets.index') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" value="{{ $filters['date'] ?? '' }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Всі статуси</option>
                <option value="new" @selected(($filters['status'] ?? '') === 'new')>Новий</option>
                <option value="in_progress" @selected(($filters['status'] ?? '') === 'in_progress')>В роботі</option>
                <option value="processed" @selected(($filters['status'] ?? '') === 'processed')>Оброблено</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $filters['email'] ?? '' }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="phone" class="form-control" placeholder="Телефон" value="{{ $filters['phone'] ?? '' }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Фільтр</button>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">Скинути</a>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Клієнт</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Тема</th>
                <th>Статус</th>
                <th>Дата</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->customer->email }}</td>
                    <td>{{ $ticket->customer->phone }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>
                        @if ($ticket->status === 'new')
                            <span class="badge bg-secondary">Новий</span>
                        @elseif ($ticket->status === 'in_progress')
                            <span class="badge bg-warning text-dark">В роботі</span>
                        @else
                            <span class="badge bg-success">Оброблено</span>
                        @endif
                    </td>
                    <td>{{ $ticket->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary">Переглянути</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Заявок не знайдено</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tickets->links() }}
@endsection