<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Support\Carbon;

class TicketRepository
{
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