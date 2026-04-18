<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class TicketRepository
{
    public function getFiltered(array $filters): LengthAwarePaginator
    {
        $query = Ticket::with('customer')->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        if (!empty($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', '%' . $filters['email'] . '%');
            });
        }

        if (!empty($filters['phone'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', '%' . $filters['phone'] . '%');
            });
        }

        return $query->paginate(15)->withQueryString();
    }

    public function findById(int $id): Ticket
    {
        return Ticket::with('customer')->findOrFail($id);
    }

    public function updateStatus(Ticket $ticket, string $status): void
    {
        $ticket->status = $status;
        $ticket->manager_response_at = $status === 'processed' ? now() : $ticket->manager_response_at;
        $ticket->save();
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function existsTodayByPhoneOrEmail(string $phone, string $email): bool
    {
        return Ticket::whereHas('customer', function ($query) use ($phone, $email) {
            $query->where('phone', $phone)->orWhere('email', $email);
        })->whereDate('created_at', today())->exists();
    }

    public function countByDay(Carbon $date): int
    {
        return Ticket::forDay($date)->count();
    }

    public function countByWeek(Carbon $date): int
    {
        return Ticket::forWeek($date)->count();
    }

    public function countByMonth(Carbon $date): int
    {
        return Ticket::forMonth($date)->count();
    }
}