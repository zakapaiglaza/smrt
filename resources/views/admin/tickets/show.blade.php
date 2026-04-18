@extends('layouts.admin')

@section('title', 'Заявка #' . $ticket->id)

@section('content')
    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary btn-sm mb-3">← Назад</a>

    <div class="row">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header">Деталі заявки #{{ $ticket->id }}</div>
                <div class="card-body">
                    <p><strong>Тема:</strong> {{ $ticket->subject }}</p>
                    <p><strong>Повідомлення:</strong></p>
                    <p class="text-muted">{{ $ticket->body }}</p>
                    <p><strong>Дата:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}</p>
                    @if ($ticket->manager_response_at)
                        <p><strong>Дата відповіді:</strong> {{ $ticket->manager_response_at->format('d.m.Y H:i') }}</p>
                    @endif
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Клієнт</div>
                <div class="card-body">
                    <p><strong>Ім'я:</strong> {{ $ticket->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
                    <p><strong>Телефон:</strong> {{ $ticket->customer->phone }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-header">Статус</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket->id) }}">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="new" @selected($ticket->status === 'new')>Новий</option>
                                <option value="in_progress" @selected($ticket->status === 'in_progress')>В роботі</option>
                                <option value="processed" @selected($ticket->status === 'processed')>Оброблено</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Зберегти</button>
                    </form>
                </div>
            </div>

            @if ($ticket->getMedia('attachments')->count() > 0)
                <div class="card">
                    <div class="card-header">Файли</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($ticket->getMedia('attachments') as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $file->file_name }}</span>
                                <a href="{{ $file->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary">Завантажити</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection